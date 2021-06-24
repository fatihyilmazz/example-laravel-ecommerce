<?php

namespace App\Services;

use App\Category;
use App\CategoryTranslation;
use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class CategoryService
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator|null
     */
    public function getCategoriesByFilter(Request $request): ?LengthAwarePaginator
    {
        try {
            return $this->categoryRepository->getCategoriesByFilter($request);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'id'        => $request->request->getInt('id'),
                'name'      => $request->request->getInt('name'),
                'order'     => $request->request->getInt('order'),
                'is_active' => $request->get('is_active'),
            ]);
        }

        return null;
    }

    /**
     * @param int $categoryId
     *
     * @return Category|null
     */
    public function getCategoryById(int $categoryId): ?Category
    {
        try {
            return $this->categoryRepository->getCategoryById($categoryId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'categoryId' => $categoryId,
            ]);
        }

        return null;
    }

    /**
     * @param array $data
     *
     * @return Category|Model|null
     *
     * @throws \Throwable
     */
    public function create(array $data): ?Category
    {
        try {
            return DB::transaction(function () use ($data) {
                $category = $this->categoryRepository->create($data);

                $translations = collect();
                foreach ($data['translations'] as $translation) {
                    $translations->push(new CategoryTranslation($translation));
                }

                $category->translations()->saveMany($translations);

                return $category;
            });
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'data' => $data,
            ]);
        }

        return null;
    }

    /**
     * @param array $data
     * @param int $categoryId
     *
     * @return bool|null
     *
     * @throws \Throwable
     */
    public function update(array $data, int $categoryId): ?bool
    {
        try {
            return DB::transaction(function () use ($data, $categoryId) {
                $category = $this->categoryRepository->find($categoryId);

                $category->update($data);

                $translations = collect();
                foreach ($data['translations'] as $translation) {
                    if (isset($translation['id'])) {
                        $category->translations()->find($translation['id'])->update($translation);
                    } else {
                        $translations->push(new CategoryTranslation($translation));
                    }
                }

                if ($translations->isNotEmpty()) {
                    $category->translations()->saveMany($translations);
                }

                return true;
            });
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'data'          => $data,
                'categoryId'    => $categoryId,
            ]);
        }

        return null;
    }

    /**
     * @param int $categoryId
     *
     * @return bool|null
     */
    public function destroy(int $categoryId): ?bool
    {
        try {
            return $this->categoryRepository->destroy($categoryId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'categoryId' => $categoryId,
            ]);
        }

        return null;
    }

    /**
     * @return Collection|null
     */
    public function pluckActiveMainCategoriesIdAndName(): ?Collection
    {
        try {
            return $this->categoryRepository->pluckActiveMainCategoriesIdAndName();
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @return Collection|null
     */
    public function pluckActiveMainCategoriesSlugAndName(): ?Collection
    {
        try {
            return $this->categoryRepository->pluckActiveMainCategoriesSlugAndName();
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @return Collection|null
     */
    public function pluckActiveCategoriesIdAndName(): ?Collection
    {
        try {
            return $this->categoryRepository->pluckActiveCategoriesIdAndName();
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param string $slug
     *
     * @return Category|null
     */
    public function getCategoryBySlug(string $slug): ?Category
    {
        try {
            return $this->categoryRepository->getCategoryBySlug($slug);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'slug' => $slug,
            ]);
        }

        return null;
    }

    /**
     * @param int $categoryId
     *
     * @return Category|null
     */
    public function getCategoryWithCurrentLocaleById(int $categoryId): ?Category
    {
        try {
            return $this->categoryRepository->getCategoryWithCurrentLocaleById($categoryId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'categoryId' => $categoryId,
            ]);
        }

        return null;
    }

    /**
     * @param array $categoryIds
     *
     * @return Collection|null
     */
    public function getSelectedCategoriesByIds(array $categoryIds): ?Collection
    {
        try {
            return $this->categoryRepository->getSelectedCategoriesByIds($categoryIds);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'categoryIds' => $categoryIds,
            ]);
        }

        return null;
    }

    /**
     * @return Collection|null
     */
    public function pluckAllCategoriesIdAndName(): ?Collection
    {
        try {
            return $this->categoryRepository->pluckAllCategoriesIdAndName();
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }
}
