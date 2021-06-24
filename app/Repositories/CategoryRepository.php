<?php

namespace App\Repositories;

use App\Category;
use App\Facades\Setting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CategoryRepository extends BaseRepository
{
    /**
     * @var Category
     */
    protected $category;

    /**
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        parent::__construct($category);

        $this->category = $category;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator
     */
    public function getCategoriesByFilter(Request $request): LengthAwarePaginator
    {
        $category = $this->category;

        if ($request->has('id') && !empty($request->request->getInt('id'))) {
            $category = $category->where('id', $request->request->getInt('id'));
        }

        if ($request->has('name') && !empty($request->request->get('name'))) {
            $category = $category->whereHas('translations', static function (Builder $query) use ($request) {
                $query->where('name', 'LIKE', "%{$request->request->get('name')}%")
                    ->where('locale', '=', app()->getLocale());
            });
        }

        if ($request->has('order') && !empty($request->request->getInt('order'))) {
            $category = $category->where('order', $request->request->getInt('order'));
        }

        if ($request->has('is_active') && !is_null($request->get('is_active'))) {
            $category = $category->where('is_active', $request->request->getBoolean('is_active'));
        }

        $category = $category->with([
            'parent:id',
        ]);

        return $category->orderBy('id', 'DESC')
        ->paginate($request->has('per_page') ?
            $request->request->getInt('per_page') :
            Setting::get('pagination_item_per_page', \App\Setting::PAGINATION_ITEM_PER_PAGE))
        ->setPath(route('admin.categories.index'));
    }

    /**
     * @param int $categoryId
     *
     * @return Category|Model|null
     */
    public function getCategoryById(int $categoryId): ?Category
    {
        return $this->category
            ->without(['translationForCurrentLocale'])
            ->with(['translations'])
            ->find($categoryId);
    }

    /**
     * @return Collection
     */
    public function pluckActiveMainCategoriesIdAndName(): Collection
    {
        return $this->category
            ->where('parent_id', null)
            ->active()
            ->join('category_translations', static function (JoinClause $join) {
                $join->on('categories.id', '=', 'category_translations.category_id')
                    ->where('category_translations.locale', '=', app()->getLocale());
            })
            ->select('categories.id', 'category_translations.name')
            ->orderBy('category_translations.name', 'ASC')
            ->pluck('name', 'id');
    }

    /**
     * @return Collection
     */
    public function pluckActiveMainCategoriesSlugAndName(): Collection
    {
        return $this->category
            ->where('parent_id', null)
            ->active()
            ->join('category_translations', static function (JoinClause $join) {
                $join->on('categories.id', '=', 'category_translations.category_id')
                    ->where('category_translations.locale', '=', app()->getLocale());
            })
            ->select('categories.id', 'category_translations.name', 'category_translations.slug')
            ->orderBy('category_translations.name', 'ASC')
            ->pluck('name', 'slug');
    }

    /**
     * @return Collection
     */
    public function pluckActiveCategoriesIdAndName(): Collection
    {
        return $this->category
            ->active()
            ->join('category_translations', static function (JoinClause $join) {
                $join->on('categories.id', '=', 'category_translations.category_id')
                    ->where('category_translations.locale', '=', app()->getLocale());
            })
            ->select('categories.id', 'category_translations.name')
            ->orderBy('category_translations.name', 'ASC')
            ->pluck('name', 'id');
    }

    /**
     * @param string $slug
     *
     * @return Category|Model|null
     */
    public function getCategoryBySlug(string $slug): ?Category
    {
        return $this->category
            ->with('subCategories')
            ->whereHas('categoryTranslations', static function (Builder $query) use ($slug) {
                $query->where('slug', '=', $slug);
            })
            ->first();
    }

    /**
     * @param int $categoryId
     *
     * @return Category|Model|null
     */
    public function getCategoryWithCurrentLocaleById(int $categoryId): ?Category
    {
        return $this->category
            ->with(['translationForCurrentLocale', 'subCategories'])
            ->where('id', '=', $categoryId)
            ->first();
    }

    /**
     * @param array $categoryIds
     *
     * @return Collection
     */
    public function getSelectedCategoriesByIds(array $categoryIds): Collection
    {
        return $this->category
            ->with(['translationForCurrentLocale'])
            ->whereIn('id', $categoryIds)
            ->get();
    }

    /**
     * @return Collection
     */
    public function pluckAllCategoriesIdAndName(): Collection
    {
        return $this->category
            ->join('category_translations', static function (JoinClause $join) {
                $join->on('categories.id', '=', 'category_translations.category_id')
                    ->where('category_translations.locale', '=', app()->getLocale());
            })
            ->select('categories.id', 'category_translations.name')
            ->orderBy('category_translations.name', 'ASC')
            ->pluck('name', 'id');
    }

//    /**
//     * @return \Illuminate\Support\Collection
//     */
//    public function getPluckAllCategoriesWithTrashed(): Collection
//    {
//        return DB::table('categories')
//            ->join('category_translations', function ($join) {
//                $join->on('categories.id', '=', 'category_translations.category_id')
//                    ->where('category_translations.locale', '=', app()->getLocale());
//            })
//            ->select('categories.id', 'category_translations.name')
//            ->pluck('name', 'id');
//    }
}
