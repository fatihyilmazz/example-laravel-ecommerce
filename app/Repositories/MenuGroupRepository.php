<?php

namespace App\Repositories;

use App\Facades\Setting;
use App\MenuGroup;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class MenuGroupRepository extends BaseRepository
{
    /**
     * @var MenuGroup
     */
    protected $menuGroup;

    /**
     * @param MenuGroup $menuGroup
     */
    public function __construct(MenuGroup $menuGroup)
    {
        parent::__construct($menuGroup);

        $this->menuGroup = $menuGroup;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator
     */
    public function getMenuGroupsByFilter(Request $request): LengthAwarePaginator
    {
        $menuGroup = $this->menuGroup;

        if ($request->has('id') && !empty($request->request->getInt('id'))) {
            $menuGroup->where('id', $request->request->getInt('id'));
        }

        if ($request->has('name') && !empty($request->request->get('name'))) {
            $menuGroup->where('name', 'LIKE', "%{$request->request->get('name')}%");
        }

        if ($request->has('order') && !empty($request->request->getInt('order'))) {
            $menuGroup->where('order', $request->request->getInt('order'));
        }

        if ($request->has('is_active') && !is_null($request->get('is_active'))) {
            $menuGroup->where('is_active', $request->request->getBoolean('is_active'));
        }

        return $menuGroup->orderBy('id', 'DESC')
            ->paginate($request->has('per_page') ?
                $request->request->getInt('per_page') :
                Setting::get('pagination_item_per_page', \App\Setting::PAGINATION_ITEM_PER_PAGE))
            ->setPath(route('admin.menu_groups.index'));
    }

    /**
     * @return Collection
     */
    public function pluckAllActiveMenuGroups(): Collection
    {
        return $this->menuGroup->active()->orderBy('name')->pluck('name', 'id');
    }

    /**
     * @return Collection
     */
    public function pluckAllMenuGroups(): Collection
    {
        return $this->menuGroup->orderBy('name')->pluck('name', 'id');
    }
}
