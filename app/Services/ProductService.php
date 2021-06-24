<?php

namespace App\Services;

use App\Category;
use App\Facades\FileFacade;
use App\Facades\Setting;
use App\Filters\ProductFilter;
use App\Media;
use App\Product;
use App\ProductTranslation;
use App\Repositories\ProductRepository;
use App\Repositories\ProductTypeRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;

class ProductService
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var ProductTypeRepository
     */
    protected $productTypeRepository;

    /**
     * @param ProductRepository $productRepository
     * @param ProductTypeRepository $productTypeRepository
     */
    public function __construct(
        ProductRepository $productRepository,
        ProductTypeRepository $productTypeRepository
    ) {
        $this->productRepository        = $productRepository;
        $this->productTypeRepository    = $productTypeRepository;
    }

    /**
     * @param Request $request
     * @param Category|null $category
     *
     * @return ProductFilter|null
     */
    public function prepareProductFilter(Request $request, ?Category $category = null): ?ProductFilter
    {
        try {
            $productFilter = new ProductFilter();

            if ($category instanceof Category) {
                $productFilter->addCategoryId($category->id);

                foreach ($category->subCategories as $subCategory) {
                    $productFilter->addCategoryId($subCategory->id);
                }
            }

            if ($request->has('ids') && !empty($request->request->get('ids'))) {
                $ids = explode(',', $request->request->get('ids'));

                foreach ($ids as $id) {
                    $productFilter->addProductId($id);
                }
            }

            if ($request->has('name') && !empty($request->request->get('name'))) {
                $productFilter->setName($request->request->get('name'));
            }

            if ($request->has('brand_id') && !empty($request->request->get('brand_id'))) {
                $productFilter->addBrandId($request->request->get('brand_id'));
            }

            if ($request->has('category_id') && !empty($request->request->get('category_id'))) {
                $productFilter->addCategoryId($request->request->get('category_id'));
            }

            if ($request->has('row_numbers') && !empty($request->request->get('row_numbers'))) {
                $rowNumbers = explode(',', $request->request->get('row_numbers'));

                foreach ($rowNumbers as $rowNumber) {
                    $productFilter->addRowNumber($rowNumber);
                }
            }

            if ($request->has('is_active') && !is_null($request->get('is_active'))) {
                $productFilter->setIsActive($request->request->getBoolean('is_active'));
            }

            $productFilter->setPerPage(
                Setting::get('pagination_item_per_page', \App\Setting::PAGINATION_ITEM_PER_PAGE)
            );

            if ($request->has('per_page')) {
                $productFilter->setPerPage($request->request->getInt('per_page'));
            }

            $productFilter->setFetchType(ProductFilter::FETCH_TYPE_PAGINATE);

            return $productFilter;
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'id' => $request->request->get('id'),
                'name' => $request->request->get('name'),
                'brand_id' => $request->request->get('brand_id'),
                'category_id' => $request->request->get('category_id'),
                'order' => $request->request->get('order'),
                'is_active' => $request->get('is_active'),
                'categoryId' => $category instanceof Category ? $category->id : null,
            ]);
        }

        return null;
    }

    /**
     * @param ProductFilter $productFilter
     *
     * @return LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection|Product|Model|null
     */
    public function getProductsByProductFilter(ProductFilter $productFilter)
    {
        try {
            //TODO Kampanyalı ve indirimli ürünlerin fiyatlarının sıralanması için yeni method eklenecek
            return $this->productRepository->getProductsByProductFilter($productFilter);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'productIds'        => $productFilter->getProductIds(),
                'brandIds'          => $productFilter->getBrandIds(),
                'categoryIds'       => $productFilter->getCategoryIds(),
                'rowNumberIds'      => $productFilter->getRowNumbers(),
                'isActive'          => $productFilter->isActive(),
                'perPage'           => $productFilter->getPerPage(),
                'fetchType'         => $productFilter->getFetchType(),
                'orderBy'           => $productFilter->getOrderBy(),
                'sortBy'            => $productFilter->getSortBy(),
                'paginationRoute'   => $productFilter->getPaginateRoute(),
            ]);
        }

        return null;
    }

    /**
     * @param int $productId
     *
     * @return Product|null
     */
    public function getProductById(int $productId): ?Product
    {
        try {
            return $this->productRepository->getProductById($productId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'productId' => $productId,
            ]);
        }

        return null;
    }

    /**
     * @param array $data
     *
     * @return Product|null
     *
     * @throws \Throwable
     */
    public function create(array $data): ?Product
    {
        try {
            //TODO Transaction başarısız ise ya da hata varsa yüklenen resimleri sildir

            return DB::transaction(function () use ($data) {
                /** @var Product $product */
                $product = $this->productRepository->create($data);

                $product = $this->createCategories($product, $data);

                if ($product instanceof Product) {
                    $product = $this->createTranslations($product, $data);
                }

                if ($product instanceof Product) {
                    $product = $this->createImages($product, $data);
                }

                if ($product instanceof Product) {
                    $product = $this->createFiles($product, $data);
                }

                return $product;
            });
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'data' => $data,
            ]);
        }

        return null;
    }

    /**
     * @param Product $product
     * @param array $data
     *
     * @return Product|null
     */
    protected function createCategories(Product $product, array $data): ?Product
    {
        try {
            $categories[$data['main_category']] =  ['is_main' => true];

            if (isset($data['sub_categories'])) {
                foreach ($data['sub_categories'] as $subCategory) {
                    $categories[$subCategory] = ['is_main' => false];
                }
            }

            $product->categories()->attach($categories);

            return $product;
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'productId' => $product->id,
                'data'      => $data,
            ]);
        }

        return null;
    }

    /**
     * @param Product $product
     * @param array $data
     *
     * @return Product|null
     */
    protected function createTranslations(Product $product, array $data): ?Product
    {
        try {
            $translations = collect();
            foreach ($data['translations'] as $translation) {
                if (!empty($translation['keywords'])) {
                    $translation['metas']['keywords'] = $translation['keywords'];

                    unset($translation['keywords']);
                }

                if (!empty($translation['description'])) {
                    $translation['metas']['description'] = $translation['description'];

                    unset($translation['description']);
                }

                $translations->push(new ProductTranslation($translation));
            }

            $product->translations()->saveMany($translations);

            return $product;
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'productId' => $product->id,
                'data'      => $data,
            ]);
        }

        return null;
    }

    /**
     * @param Product $product
     * @param array $data
     *
     * @return Product|null
     */
    protected function createImages(Product $product, array $data): ?Product
    {
        try {
            if (isset($data['images'])) {
                $images = collect();

                foreach ($data['images'] as $order => $image) {
                    $source = FileFacade::upload(
                        public_path(env('IMAGE_PATH_PRODUCT', Media::DEFAULT_IMAGE_PATH_PRODUCT)),
                        (string)$product->id,
                        $image['source']
                    );

                    if (!empty($source)) {
                        $attributes = [
                            'media_type' => Media::TYPE_ID_IMAGE,
                            'source' => $source,
                            'order' => $order,
                        ];

                        if (!empty($image['alt'])) {
                            $attributes['content'] = [
                                'alt' => $image['alt'],
                            ];
                        }

                        $images->push(new Media($attributes));
                    }
                }

                if ($images->isNotEmpty()) {
                    $product->images()->saveMany($images);

                    return $product;
                }
            }
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'productId' => $product->id,
                'data'      => $data,
            ]);
        }

        return null;
    }

    /**
     * @param Product $product
     * @param array $data
     *
     * @return Product|null
     */
    protected function createFiles(Product $product, array $data): ?Product
    {
        try {
            if (isset($data['files'])) {
                $files = collect();

                foreach ($data['files'] as $order => $file) {
                    $source = FileFacade::upload(
                        public_path(env('IMAGE_PATH_PRODUCT', Media::DEFAULT_FILE_PATH_PRODUCT)),
                        (string)$product->id,
                        $file['source']
                    );

                    if (!empty($source)) {
                        $attributes = [
                            'media_type' => Media::TYPE_ID_FILE,
                            'source' => $source,
                            'order' => $order,
                        ];

                        if (!empty($file['alt'])) {
                            $attributes['content'] = [
                                'alt' => $file['alt'],
                            ];
                        }

                        $files->push(new Media($attributes));
                    }
                }

                if ($files->isNotEmpty()) {
                    $product->files()->saveMany($files);

                    return $product;
                }
            }

            return $product;
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'productId' => $product->id,
                'data'      => $data,
            ]);
        }

        return null;
    }


    /**
     * @param array $data
     * @param int $productId
     *
     * @return bool|null
     */
    public function update(array $data, int $productId): ?bool
    {
        try {
            //TODO Transaction başarısız ise yüklenen resimleri sildir
            return DB::transaction(function () use ($data, $productId) {
                /** @var Product $product */
                $product = $this->productRepository->find($productId);

                $product->update($data);


                $product = $this->updateCategories($product, $data);

                if ($product instanceof Product) {
                    $product = $this->updateTranslations($product, $data);
                }

                $unUsedImages = collect();
                $unUsedFiles = collect();
                if ($product instanceof Product) {
                    $unUsedImages = $this->findUnusedImages($product, $data);
                    $unUsedFiles = $this->findUnusedFiles($product, $data);
                }

                if ($product instanceof Product) {
                    $product = $this->updateImages($product, $data);
                }

                if ($product instanceof  Product) {
                    $product = $this->updateFiles($product, $data);
                }

                if ($unUsedImages->isNotEmpty() || $unUsedFiles->isNotEmpty()) {
                    $unUsedMedias = $unUsedImages->merge($unUsedFiles);

                    $product = $this->deleteUnusedMedias($product, $unUsedMedias);
                }

                return ($product instanceof Product);
            });
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'productId' => $productId,
                'data'      => $data,
            ]);
        }

        return null;
    }

    /**
     * @param Product $product
     * @param array $data
     *
     * @return Product|null
     */
    protected function updateCategories(Product $product, array $data): ?Product
    {
        try {
            $categories[$data['main_category']] =  ['is_main' => true];

            if (isset($data['sub_categories'])) {
                foreach ($data['sub_categories'] as $subCategory) {
                    $categories[$subCategory] = ['is_main' => false];
                }
            }

            $product->categories()->sync($categories);

            return $product;
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'productId' => $product->id,
                'data'      => $data,
            ]);
        }

        return null;
    }

    /**
     * @param Product $product
     * @param array $data
     *
     * @return Product|null
     */
    protected function updateTranslations(Product $product, array $data): ?Product
    {
        try {
            $translations = collect();
            foreach ($data['translations'] as $translation) {
                $translation['metas'] = null;

                if (!empty($translation['keywords'])) {
                    $translation['metas']['keywords'] = $translation['keywords'];

                    unset($translation['keywords']);
                }

                if (!empty($translation['description'])) {
                    $translation['metas']['description'] = $translation['description'];

                    unset($translation['description']);
                }

                if (isset($translation['id'])) {
                    $product->translations()->find($translation['id'])->update($translation);
                } else {
                    $translations->push(new ProductTranslation($translation));
                }
            }

            if ($translations->isNotEmpty()) {
                $product->translations()->saveMany($translations);
            }

            return $product;
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'productId' => $product->id,
                'data'      => $data,
            ]);
        }

        return null;
    }

    /**
     * @param Product $product
     * @param array $data
     *
     * @return Product|null
     */
    protected function updateImages(Product $product, array $data): ?Product
    {
        try {
            if (count($data['images'] ?? []) > 0) {
                $images = collect();

                foreach ($data['images'] as $order => $image) {
                    $attributes['order'] = $order;

                    if (!empty($image['alt'])) {
                        $attributes['content'] = [
                            'alt' => $image['alt'],
                        ];
                    }

                    if (isset($image['isExists']) && $image['isExists'] == 1) {
                        $product->images()->find($image['id'])->update($attributes);
                    } else {
                        $source = FileFacade::upload(
                            public_path(env('IMAGE_PATH_PRODUCT', Media::DEFAULT_IMAGE_PATH_PRODUCT)),
                            (string)$product->id,
                            $image['source']
                        );

                        if (!empty($source)) {
                            $attributes['media_type'] = Media::TYPE_ID_IMAGE;
                            $attributes['source'] = $source;

                            $images->push(new Media($attributes));
                        }
                    }
                }

                if ($images->isNotEmpty()) {
                    $product->images()->saveMany($images);
                }
            }

            return  $product;
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'productId' => $product->id,
                'data'      => $data,
            ]);
        }

        return null;
    }

    /**
     * @param Product $product
     * @param array $data
     *
     * @return Product|null
     */
    protected function updateFiles(Product $product, array $data): ?Product
    {
        try {
            if (count($data['files'] ?? []) > 0) {
                $files = collect();

                foreach ($data['files'] as $order => $file) {
                    $attributes['order'] = $order;

                    if (!empty($file['alt'])) {
                        $attributes['content'] = [
                            'alt' => $file['alt'],
                        ];
                    }

                    if (isset($file['isExists']) && $file['isExists'] == 1) {
                        $product->files()->find($file['id'])->update($attributes);
                    } else {
                        $source = FileFacade::upload(
                            public_path(env('FILE_PATH_PRODUCT', Media::DEFAULT_FILE_PATH_PRODUCT)),
                            (string)$product->id,
                            $file['source']
                        );

                        if (!empty($source)) {
                            $attributes['media_type'] = Media::TYPE_ID_FILE;
                            $attributes['source'] = $source;

                            $files->push(new Media($attributes));
                        }
                    }
                }

                if ($files->isNotEmpty()) {
                    $product->files()->saveMany($files);
                }
            }

            return  $product;
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'productId' => $product->id,
                'data'      => $data,
            ]);
        }

        return null;
    }

    /**
     * @param Product $product
     * @param array $data
     *
     * @return Collection|null
     */
    protected function findUnusedImages(Product $product, array $data): ?Collection
    {
        try {
            $unusedImages = collect();

            $registeredImageIds = $product->images()->get(['id', 'source', 'media_type']);

            if ($registeredImageIds->isNotEmpty()) {
                if (count($data['images'] ?? []) === 0) {
                    foreach ($registeredImageIds as $registeredImage) {
                        $unusedImages->push($registeredImage);
                    }
                } else {
                    foreach ($registeredImageIds as $registeredImage) {
                        $isExists = false;

                        foreach ($data['images'] as $image) {
                            if (( $image['isExists'] ?? null) == 1
                                && ($registeredImage['id'] ?? null) == $image['id']
                            ) {
                                $isExists = true;
                                break;
                            }
                        }

                        if (!$isExists) {
                            $unusedImages->push($registeredImage);
                        }
                    }
                }
            }

            return $unusedImages;
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'productId' => $product->id,
                'data'      => $data,
            ]);
        }

        return null;
    }

    /**
     * @param Product $product
     * @param array $data
     *
     * @return Collection|null
     */
    protected function findUnusedFiles(Product $product, array $data): ?Collection
    {
        try {
            $unusedFiles = collect();

            $registeredFileIds = $product->files()->get(['id', 'source', 'media_type']);

            if ($registeredFileIds->isNotEmpty()) {
                if (count($data['files'] ?? []) === 0) {
                    foreach ($registeredFileIds as $registeredFile) {
                        $unusedFiles->push($registeredFile);
                    }
                } else {
                    foreach ($registeredFileIds as $registeredFile) {
                        $isExists = false;

                        foreach ($data['files'] as $file) {
                            if (($file['isExists'] ?? null) == 1
                                && ($registeredFile['id'] ?? null) == $file['id']
                            ) {
                                $isExists = true;
                                break;
                            }
                        }

                        if (!$isExists) {
                            $unusedFiles->push($registeredFile);
                        }
                    }
                }
            }

            return $unusedFiles;
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'productId' => $product->id,
                'data'      => $data,
            ]);
        }

        return null;
    }

    /**
     * @param Product $product
     * @param Collection $unUsedMedias
     *
     * @return Product|null
     */
    protected function deleteUnusedMedias(Product $product, Collection $unUsedMedias): ?Product
    {
        try {
            if ($unUsedMedias->isNotEmpty()) {
                foreach ($unUsedMedias as $media) {
                    $isFileDeleted = false;

                    if ($media['media_type'] === Media::TYPE_ID_IMAGE) {
                        $isDataDeleted = $product->images()->find($media['id'])->delete();

                        if ($isDataDeleted) {
                            //TODO Media type ına göre path verilip silinecek
                            $isFileDeleted = File::delete(
                                public_path(env('IMAGE_PATH_PRODUCT', Media::DEFAULT_IMAGE_PATH_PRODUCT)).
                                $media['source']
                            );
                        }
                    } else {
                        $isDataDeleted = $product->files()->find($media['id'])->delete();

                        if ($isDataDeleted) {
                            //TODO Media type ına göre path verilip silinecek
                            $isFileDeleted = File::delete(
                                public_path(env('FILE_PATH_PRODUCT', Media::DEFAULT_FILE_PATH_PRODUCT)).
                                $media['source']
                            );
                        }
                    }

                    if (!$isDataDeleted || !$isFileDeleted) {
                        return null;
                    }
                }
            }

            return $product;
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'productId'     => $product->id,
                'unUsedMedias'  => $unUsedMedias,
            ]);
        }

        return null;
    }

    /**
     * @param int $productId
     *
     * @return bool|null
     */
    public function destroy(int $productId): ?bool
    {
        try {
            return $this->productRepository->destroy($productId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'productId' => $productId,
            ]);
        }

        return null;
    }

    /**
     * @return Collection|null
     */
    public function pluckAllActiveProductTypes(): ?Collection
    {
        try {
            return $this->productTypeRepository->pluckAllActiveProductTypes();
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }
}
