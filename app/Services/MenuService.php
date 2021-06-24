<?php

namespace App\Services;

use App\Category;
use App\Menu;
use App\MenuGroup;
use App\MenuTranslation;
use App\MenuType;
use App\Page;
use App\Repositories\MenuGroupRepository;
use App\Repositories\MenuRepository;
use App\Repositories\MenuTypeRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class MenuService
{
    /**
     * @var MenuGroupRepository
     */
    protected $menuGroupRepository;

    /**
     * @var MenuTypeRepository
     */
    protected $menuTypeRepository;

    /**
     * @var MenuRepository
     */
    protected $menuRepository;

    /**
     * @var PageService
     */
    protected $pageService;

    /**
     * @var CategoryService
     */
    protected $categoryService;

    /**
     * @var BrandService
     */
    protected $brandService;

    /**
     * @param MenuGroupRepository $menuGroupRepository
     * @param MenuTypeRepository $menuTypeRepository
     * @param MenuRepository $menuRepository
     * @param PageService $pageService
     * @param CategoryService $categoryService
     * @param BrandService $brandService
     */
    public function __construct(
        MenuGroupRepository $menuGroupRepository,
        MenuTypeRepository $menuTypeRepository,
        MenuRepository $menuRepository,
        PageService $pageService,
        CategoryService $categoryService,
        BrandService $brandService
    ) {
        $this->menuGroupRepository  = $menuGroupRepository;
        $this->menuTypeRepository   = $menuTypeRepository;
        $this->menuRepository       = $menuRepository;
        $this->pageService          = $pageService;
        $this->categoryService      = $categoryService;
        $this->brandService         = $brandService;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator|null
     */
    public function getMenuGroupsByFilter(Request $request): ?LengthAwarePaginator
    {
        try {
            return $this->menuGroupRepository->getMenuGroupsByFilter($request);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator|null
     */
    public function getMenusByFilter(Request $request): ?LengthAwarePaginator
    {
        try {
            return $this->menuRepository->getMenusByFilter($request);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param array $data
     * @return MenuGroup|Model|null
     */
    public function createMenuGroup(array $data): ?MenuGroup
    {
        try {
            return $this->menuGroupRepository->create($data);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param array $data
     * @param int $menuGroupId
     *
     * @return bool|null
     */
    public function updateMenuGroup(array $data, int $menuGroupId): ?bool
    {
        try {
            return $this->menuGroupRepository->update($data, $menuGroupId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param int $menuGroupId
     *
     * @return bool|null
     */
    public function destroyMenuGroup(int $menuGroupId): ?bool
    {
        try {
            return $this->menuGroupRepository->destroy($menuGroupId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @return Collection|null
     */
    public function pluckAllActiveMenuGroups(): ?Collection
    {
        try {
            return $this->menuGroupRepository->pluckAllActiveMenuGroups();
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @return Collection|null
     */
    public function pluckAllActiveParentMenus(): ?Collection
    {
        try {
            return $this->menuRepository->pluckAllActiveParentMenus();
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param int $menuId
     *
     * @return Menu|null
     */
    public function getMenuById(int $menuId): ?Menu
    {
        try {
            return $this->menuRepository->getMenuById($menuId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param array $data
     *
     * @return Model|null
     */
    public function createMenu(array $data): ?Menu
    {
        try {
            return DB::transaction(function () use ($data) {
                $data = $this->setMenuValue($data);

                $menu = $this->menuRepository->create($data);

                $translations = collect();
                foreach ($data['translations'] as $translation) {
                    $translations->push(new MenuTranslation($translation));
                }

                $menu->translations()->saveMany($translations);

                return $menu;
            });
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param array $data
     * @param int $menuId
     *
     * @return bool|null
     */
    public function updateMenu(array $data, int $menuId): ?bool
    {
        try {
            return DB::transaction(function () use ($data, $menuId) {
                $menu = $this->menuRepository->find($menuId);

                $data = $this->setMenuValue($data);

                $menu->update($data);

                $translations = collect();
                foreach ($data['translations'] as $translation) {
                    if (isset($translation['id'])) {
                        $menu->translations()->find($translation['id'])->update($translation);
                    } else {
                        $translations->push(new MenuTranslation($translation));
                    }
                }

                if ($translations->isNotEmpty()) {
                    $menu->translations()->saveMany($translations);
                }

                return true;
            });
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param int $menuId
     *
     * @return bool|null
     */
    public function destroyMenu(int $menuId): ?bool
    {
        try {
            return $this->menuRepository->destroy($menuId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @return Collection|null
     */
    public function pluckAllMenuTypes(): ?Collection
    {
        try {
            return $this->menuTypeRepository->pluckAllMenuTypes();
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @return Collection|null
     */
    public function getActiveHeaderMenus(): ?Collection
    {
        try {
            return Cache::remember(sprintf('%s%s', Menu::CACHE_KEY_HEADER_MENU_LOCALE, app()->getLocale()), Menu::CACHE_EXPIRATION_TIME, function () {
                $headerMenus =  $this->menuRepository->getActiveHeaderMenus();

                $menuCollections = Collection::make();

                foreach ($headerMenus as $menu) {
                    $menu = $this->createMenuCollection($menu);

                    if (is_array($menu)) {
                        $menuCollections->add($menu);
                    } else {
                        return false;
                    }
                }

                return $menuCollections;
            });
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param Menu $menu
     *
     * @return array|null
     */
    private function createMenuCollection(Menu $menu): ?array
    {
        try {
            if ($menu->menu_type_id === MenuType::ID_MAIN_PAGE) {
                $menu = [
                    'name'      => $menu->translationForCurrentLocale->name,
                    'link'      => route('web.index'),
                    'subMenus'  => Collection::make(),
                    'urls'      => Collection::make([route('web.index')]),
                ];
            } elseif ($menu->menu_type_id === MenuType::ID_PAGE) {
                $page = $this->pageService->getPageWithCurrentLocaleById($menu->value[0]);

                if (!$page instanceof Page) {
                    return null;
                }

                $menu = [
                    'name' => $menu->translationForCurrentLocale->name,
                    'link' => route('web.pages', [
                        'slug' => $page->translationForCurrentLocale->slug
                    ]),
                    'subMenus' => Collection::make(),
                    'urls' => Collection::make([
                        route('web.pages', [
                            'slug' => $page->translationForCurrentLocale->slug
                        ])
                    ]),
                ];
            } elseif ($menu->menu_type_id === MenuType::ID_EXTERNAL_LINK) {
                $menu = [
                    'name'      => $menu->translationForCurrentLocale->name,
                    'link'      => $menu->value[0],
                    'subMenus'  => Collection::make(),
                    'urls'      => Collection::make(),
                ];
            } elseif ($menu->menu_type_id === MenuType::ID_MAIN_CATEGORY) {
                $mainCategory = $this->categoryService->getCategoryWithCurrentLocaleById($menu->value[0]);

                if (!($mainCategory instanceof Category)) {
                    return null;
                }

                $subMenus   = Collection::make();
                $parentUrls = Collection::make([
                    route('web.categories.index', [
                        'slug' => $mainCategory->translationForCurrentLocale->slug
                    ])
                ]);

                foreach ($mainCategory->subCategories as $subCategory) {
                    $subMenu = [
                        'name' => $subCategory->translationForCurrentLocale->name,
                        'link' => route('web.categories.index', [
                            'slug' => $subCategory->translationForCurrentLocale->slug
                        ]),
                        'urls' => Collection::make([
                            route('web.categories.index', [
                                'slug' => $subCategory->translationForCurrentLocale->slug
                            ])
                        ]),
                    ];

                    $parentUrls->add(route('web.categories.index', [
                        'slug' => $subCategory->translationForCurrentLocale->slug
                    ]));

                    $subMenus->add($subMenu);
                }

                $menu = [
                    'name' => $menu->translationForCurrentLocale->name,
                    'link' => route('web.categories.index', [
                        'slug' => $mainCategory->translationForCurrentLocale->slug
                    ]),
                    'subMenus' => $subMenus,
                    'urls' => $parentUrls,
                ];
            } elseif ($menu->menu_type_id === MenuType::ID_SELECTED_CATEGORIES) {
                $selectedCategories = $this->categoryService->getSelectedCategoriesByIds($menu->value);

                if (!($selectedCategories instanceof Collection)) {
                    return null;
                }

                $subMenus   = Collection::make();
                $parentUrls = Collection::make();

                foreach ($selectedCategories as $category) {
                    $subMenu = [
                        'name' => $category->translationForCurrentLocale->name,
                        'link' => route('web.categories.index', [
                            'slug' => $category->translationForCurrentLocale->slug,
                        ]),
                        'subMenus' => Collection::make(),
                        'urls' => Collection::make([
                            route('web.categories.index', [
                                'slug' => $category->translationForCurrentLocale->slug,
                            ]),
                        ]),
                    ];

                    $parentUrls->add(route('web.categories.index', [
                        'slug' => $category->translationForCurrentLocale->slug,
                    ]));

                    $subMenus->add($subMenu);
                }

                $menu = [
                    'name'      => $menu->translationForCurrentLocale->name,
                    'link'      => null,
                    'subMenus'  => $subMenus,
                    'urls'      => $parentUrls,
                ];
            } elseif ($menu->menu_type_id === MenuType::ID_BRANDS) {
                $brands = $this->brandService->getSelectedBrandsByIds($menu->value);

                if (!($brands instanceof Collection)) {
                    return null;
                }

                $subMenus   = Collection::make();
                $parentUrls = Collection::make();

                foreach ($brands as $brand) {
                    $subMenu = [
                        'name' => $brand->name,
                        'link' => route('web.brands.index', [
                            'brand' => $brand->name,
                        ]),
                        'subMenus' => Collection::make(),
                        'urls' => Collection::make([
                            route('web.brands.index', [
                                'brand' => $brand->name,
                            ]),
                        ]),
                    ];

                    $parentUrls->add(route('web.brands.index', [
                        'brand' => $brand->name,
                    ]));

                    $subMenus->add($subMenu);
                }

                $menu = [
                    'name'      => $menu->translationForCurrentLocale->name,
                    'link'      => null,
                    'subMenus'  => $subMenus,
                    'urls'      => $parentUrls,
                ];
            } elseif ($menu->menu_type_id === MenuType::ID_STATIC_PAGE) {
                $menu = [
                    'name'      => $menu->translationForCurrentLocale->name,
                    'link'      => route('web.static_pages.' . $menu->value[0]),
                    'subMenus'  => Collection::make(),
                    'urls'      => Collection::make([route('web.static_pages.' . $menu->value[0])]),
                ];
            } else {
                $subMenus = Collection::make();
                foreach ($menu->subMenus as $subMenu) {
                    $subMenu = $this->createMenuCollection($subMenu);

                    if (!empty($subMenu)) {
                        $subMenus->add($subMenu);
                    } else {
                        return null;
                    }
                }

                $parentUrls = Collection::make();

                foreach ($subMenus as $subMenu) {
                    foreach ($subMenu['urls'] as $url) {
                        $parentUrls->add($url);
                    }
                }

                $menu = [
                    'name'      => $menu->translationForCurrentLocale->name,
                    'link'      => null,
                    'subMenus'  => $subMenus,
                    'urls'      => $parentUrls,
                ];
            }

            return $menu;
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'menu' => [
                    'id' => $menu->id,
                    'name' => $menu->translationForCurrentLocale->name,
                ]
            ]);
        }

        return null;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    private function setMenuValue(array $data): array
    {
        if (!empty($data['page_id'])) {
            $data['value'] = $data['page_id'];
        } elseif (!empty($data['external_link'])) {
            $data['value'] = $data['external_link'];
        } elseif (!empty($data['main_category_id'])) {
            $data['value'] = $data['main_category_id'];
        } elseif (!empty($data['category_ids'])) {
            $data['value'] = $data['category_ids'];
        } elseif (!empty($data['brand_ids'])) {
            $data['value'] = $data['brand_ids'];
        } elseif (!empty($data['static_page'])) {
            $data['value'] = $data['static_page'];
        }

        return $data;
    }

    /**
     * @return Collection|null
     */
    public function pluckAllParentMenus(): ?Collection
    {
        try {
            return $this->menuRepository->pluckAllParentMenus();
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @return Collection|null
     */
    public function pluckAllMenuGroups(): ?Collection
    {
        try {
            return $this->menuGroupRepository->pluckAllMenuGroups();
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

//    /**
//     * @return \Illuminate\Support\Collection
//     */
//    public function getPluckAllMenusWithTrashed(): Collection
//    {
//        try {
//            return $this->menuRepository->getPluckAllMenusWithTrashed();
//        } catch (\Exception $exception) {
//            Log::warning($exception);
//        } catch (\Error $exception) {
//            Log::error($exception);
//        }
//
//        return collect();
//    }
//
//    /**
//     * @return \Illuminate\Support\Collection
//     */
//    public function getAllIdAndNameWithTrashed(): \Illuminate\Support\Collection
//    {
//        try {
//            return $this->menuGroupRepository->getAllIdAndNameWithTrashed();
//        } catch (\Exception $exception) {
//            Log::warning($exception);
//        } catch (\Error $exception) {
//            Log::error($exception);
//        }
//
//        return collect();
//    }
}
