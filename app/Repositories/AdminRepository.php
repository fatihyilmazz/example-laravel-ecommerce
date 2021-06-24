<?php

namespace App\Repositories;

use App\Admin;
use App\Facades\Setting;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class AdminRepository extends BaseRepository
{
    /**
     * @var Admin
     */
    protected $admin;

    /**
     * @param Admin $admin
     */
    public function __construct(Admin $admin)
    {
        parent::__construct($admin);

        $this->admin = $admin;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator
     */
    public function getAdminsByFilter(Request $request): LengthAwarePaginator
    {
        $admin = $this->admin;

        if ($request->has('id') && !empty($request->request->getInt('id'))) {
            $admin = $admin->where('id', $request->request->getInt('id'));
        }

        if ($request->has('name') && !empty($request->request->get('name'))) {
            $admin = $admin->orWhere('first_name', 'LIKE', "%{$request->request->get('name')}%");
            $admin = $admin->orWhere('last_name', 'LIKE', "%{$request->request->get('name')}%");
        }

        if ($request->has('email') && !empty($request->request->get('email'))) {
            $admin = $admin->where('email', '=', "%{$request->request->get('email')}%");
        }

        if ($request->has('phone_number') && !empty($request->request->get('phone_number'))) {
            $admin = $admin->where('phone_number', '=', "%{$request->request->get('phone_number')}%");
        }

        if ($request->has('is_active') && !is_null($request->get('is_active'))) {
            $admin = $admin->where('is_active', $request->request->getBoolean('is_active'));
        }

        return $admin->orderBy('id', 'DESC')
            ->paginate($request->has('per_page') ?
                $request->request->getInt('per_page') :
                Setting::get('pagination_item_per_page', \App\Setting::PAGINATION_ITEM_PER_PAGE))
            ->setPath(route('admin.admins.index'));
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getAllPanelAdminsIdAndNameWithTrashed(): \Illuminate\Support\Collection
    {
        return $this->admin->withTrashed()
            ->select(DB::raw("CONCAT(first_name,' ',last_name) AS name"), 'id')
            ->pluck('name', 'id');
    }
}
