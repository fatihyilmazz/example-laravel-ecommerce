<?php

namespace App\Repositories;

use App\Role;
use App\Facades\Setting;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class RoleRepository extends BaseRepository
{
    /**
     * @var Role
     */
    protected $role;

    /**
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        parent::__construct($role);

        $this->role = $role;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator
     */
    public function getRolesByFilter(Request $request): LengthAwarePaginator
    {
        $role = $this->role;

        if ($request->has('id') && !empty($request->request->getInt('id'))) {
            $role = $role->where('id', $request->request->getInt('id'));
        }

        if ($request->has('name') && !empty($request->get('name'))) {
            $role = $role->where('name','LIKE','%' . $request->request->get('name') . '%');
        }

        return $role->orderBy('id', 'ASC')
        ->paginate($request->has('per_page') ?
            $request->request->getInt('per_page') :
            Setting::get('pagination.item_per_page', \App\Setting::PAGINATION_ITEM_PER_PAGE))
        ->setPath(route('admin.categories.index'));
    }
}
