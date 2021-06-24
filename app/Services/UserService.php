<?php

namespace App\Services;

use App\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class UserService
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator
     */
    public function getUsersByFilter(Request $request): ?LengthAwarePaginator
    {
        try {
            return $this->userRepository->getUsersByFilter($request);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'request' => $request,
            ]);
        }

        return null;
    }

    /**
     * @param array $data
     *
     * @return User|Model|null
     */
    public function create(array $data): ?User
    {
        try {
            return $this->userRepository->create($data);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'data' => $data,
            ]);
        }

        return null;
    }

    /**
     * @param array $data
     * @param int $userId
     *
     * @return bool|null
     */
    public function update(array $data, int $userId): ?bool
    {
        try {
            return $this->userRepository->update($data, $userId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'data'      => $data,
                'userId'    => $userId,
            ]);
        }

        return null;
    }

    /**
     * @param int $userId
     *
     * @return bool|null
     */
    public function destroy(int $userId): ?bool
    {
        try {
            return $this->userRepository->destroy($userId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'userId' => $userId,
            ]);
        }

        return null;
    }
}
