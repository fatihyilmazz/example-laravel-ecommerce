<?php

namespace App\Repositories;

use App\Facades\Setting;
use App\Menu;
use App\MenuGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class MenuRepository extends BaseRepository
{
    /**
     * @var Menu
     */
    protected $menu;

    /**
     * @param Menu $menu
     */
    public function __construct(Menu $menu)
    {
        parent::__construct($menu);

        $this->menu = $menu;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator
     */
    public function getMenusByFilter(Request $request): LengthAwarePaginator
    {
        $menu = $this->menu;

        if ($request->has('id') && !empty($request->request->getInt('id'))) {
            $menu = $menu->where('id', $request->request->getInt('id'));
        }

        if ($request->has('name') && !empty($request->request->get('name'))) {
            $menu = $menu->whereHas('translations', static function (Builder $query) use ($request) {
                $query->where('name', 'LIKE', "%{$request->request->get('name')}%")
                    ->where('locale', '=', app()->getLocale());
            });
        }

        if ($request->has('menu_group_id') && !empty($request->request->get('menu_group_id'))) {
            $menu = $menu->where('menu_group_id', '=', $request->request->get('menu_group_id'));
        }

        if ($request->has('menu_type_id') && !empty($request->request->get('menu_type_id'))) {
            $menu = $menu->where('menu_type_id', '=', $request->request->get('menu_type_id'));
        }

        if ($request->has('parent_id') && !empty($request->request->get('parent_id'))) {
            $menu = $menu->where('parent_id', '=', $request->request->get('parent_id'));
        }

        if ($request->has('order') && !empty($request->request->getInt('order'))) {
            $menu = $menu->where('order', $request->request->getInt('order'));
        }

        if ($request->has('is_active') && !is_null($request->get('is_active'))) {
            $menu = $menu->where('is_active', $request->request->getBoolean('is_active'));
        }

        $menu = $menu->with([
            'menuType:id,translation_key',
            'menuGroup:id,name',
            'parent:id',
        ]);

        return $menu->orderBy('id', 'DESC')
        ->paginate($request->has('per_page') ?
            $request->request->getInt('per_page') :
            Setting::get('pagination_item_per_page', \App\Setting::PAGINATION_ITEM_PER_PAGE))
        ->setPath(route('admin.menus.index'));
    }

    /**
     * @param int $menuId
     *
     * @return Menu|Model|null
     */
    public function getMenuById(int $menuId): ?Menu
    {
        return $this->menu
            ->without(['translationForCurrentLocale'])
            ->with(['translations'])
            ->find($menuId);
    }

    /**
     * @return Collection
     */
    public function pluckAllActiveParentMenus(): Collection
    {
        return $this->menu
            ->active()
            ->join('menu_translations', static function (JoinClause $join) {
                $join->on('menus.id', '=', 'menu_translations.menu_id')
                    ->where('menu_translations.locale', '=', app()->getLocale());
            })
            ->whereNull('menu_type_id')
            ->orderBy('name')
            ->select('menus.id', 'menu_translations.name')
            ->pluck('name', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getActiveHeaderMenus(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->menu
            ->active()
            ->where('menu_group_id', '=', MenuGroup::ID_HEADER)
            ->whereNull('parent_id')
            ->with([
                'subMenus' => function (HasMany $query) {
                    $query->orderBy('row', 'ASC');
                },
            ])
            ->orderBy('row', 'ASC')
            ->get();
    }

    /**
     * @return Collection
     */
    public function pluckAllParentMenus(): Collection
    {
        return $this->menu
            ->join('menu_translations', static function (JoinClause $join) {
                $join->on('menus.id', '=', 'menu_translations.menu_id')
                    ->where('menu_translations.locale', '=', app()->getLocale());
            })
            ->whereNull('menu_type_id')
            ->orderBy('name')
            ->select('menus.id', 'menu_translations.name')
            ->pluck('name', 'id');
    }

//    /**
//     * @return \Illuminate\Support\Collection
//     */
//    public function getPluckAllMenusWithTrashed(): Collection
//    {
//        return DB::table('menus')
//            ->join('menu_translations', function ($join) {
//                $join->on('menus.id', '=', 'menu_translations.menu_id')
//                    ->where('menu_translations.locale', '=', app()->getLocale());
//            })
//            ->select('menus.id', 'menu_translations.name')
//            ->pluck('name', 'id');
//    }
}
