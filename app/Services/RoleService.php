<?php

namespace App\Services;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\RoleRepository;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\PermissionRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class RoleService
{
    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    /**
     * @var PermissionRepository
     */
    protected $permissionRepository;

    /**
     * @param RoleRepository $roleRepository
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        $this->roleRepository       = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator|null
     */
    public function getRolesByFilter(Request $request): ?LengthAwarePaginator
    {
        try {
            return $this->roleRepository->getRolesByFilter($request);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'id'    => $request->request->getInt('id'),
                'name'  => $request->request->get('name'),
            ]);
        }

        return null;
    }

    /**
     * @param array $data
     *
     * @return Role|Model|null
     */
    public function create(array $data): ?Role
    {
        try {
            return DB::transaction(function () use ($data) {
                $permissions = [];
                foreach ($data['permissions'] as $key => $permission) {
                    $permissions[] = $this->permissionRepository
                        ->findByAttributes([
                            'name' => $key
                        ]);
                }

                $role = $this->roleRepository->create([
                    'guard_name' => 'admin',
                    'name' => $data['name']
                ])->givePermissionTo($permissions);

                if ($role instanceof Role) {
                    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

                    return $role;
                }

                return false;
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
     * @param int $roleId
     *
     * @return bool|null
     */
    public function update(array $data, int $roleId): ?bool
    {
        try {
            return DB::transaction(function () use ($data, $roleId) {
                $role = $this->roleRepository->find($roleId);

                $role->update([
                    'name' => $data['name']
                ]);

                $permissions = [];
                foreach ($data['permissions'] as $key => $permission) {
                    $permissions[] = $this->permissionRepository
                        ->findByAttributes([
                            'name' => $key
                        ]);
                }

                $role->syncPermissions($permissions);

                return true;
            });
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'data'      => $data,
                'roleId'    => $roleId,
            ]);
        }

        return null;
    }

    /**
     * @param int $roleId
     *
     * @return bool|null
     */
    public function destroy(int $roleId): ?bool
    {
        try {
            return $this->roleRepository->destroy($roleId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'roleId' => $roleId,
            ]);
        }

        return null;
    }
}
