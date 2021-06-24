<?php

namespace App\Repositories;

use App\Facades\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository extends BaseRepository
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);

        $this->user = $user;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator
     */
    public function getUsersByFilter(Request $request): LengthAwarePaginator
    {
        $user = $this->user;

        if ($request->has('id') && !empty($request->request->getInt('id'))) {
            $user = $user->where('id', $request->request->getInt('id'));
        }

        if ($request->has('name') && !empty($request->request->get('name'))) {
            $user = $user->orWhere('first_name', 'LIKE', "%{$request->request->get('name')}%");
            $user = $user->orWhere('last_name', 'LIKE', "%{$request->request->get('name')}%");
        }

        if ($request->has('email') && !empty($request->request->get('email'))) {
            $user = $user->where('email', '=', "%{$request->request->get('email')}%");
        }

        if ($request->has('phone_number') && !empty($request->request->get('phone_number'))) {
            $user = $user->where('phone_number', '=', "%{$request->request->get('phone_number')}%");
        }

        if ($request->has('is_active') && !is_null($request->get('is_active'))) {
            $user = $user->where('is_active', $request->request->getBoolean('is_active'));
        }

        return $user->orderBy('id', 'DESC')
            ->paginate($request->has('per_page') ?
                $request->request->getInt('per_page') :
                Setting::get('pagination_item_per_page', \App\Setting::PAGINATION_ITEM_PER_PAGE))
            ->setPath(route('admin.users.index'));
    }
}
