<?php

namespace App\Repositories;

use App\Facades\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class ActivityLogRepository extends BaseRepository
{
    public const ORDER_BY_ID = 1;
    public const ORDER_BY_LOG_NAME = 2;
    public const ORDER_BY_DESCRIPTION = 3;

    public const SORT_BY_ASC = 1;
    public const SORT_BY_DESC = 2;

    /**
     * @var Activity
     */
    protected $activity;

    /**
     * @param Activity $activity
     */
    public function __construct(Activity $activity)
    {
        parent::__construct($activity);

        $this->activity = $activity;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator
     */
    public function getActivitiesByFilter(Request $request): LengthAwarePaginator
    {
        $activity = $this->activity->newQuery();

        if ($request->get('id', null)) {
            $activity->where('id', $request->get('id'));
        }

        if ($request->request->get('log_name', null)) {
            $activity->where('log_name', 'LIKE', "%{$request->get('log_name')}%");
        }

        if ($request->request->get('description', null)) {
            $activity->where('description', $request->request->getAlpha('description'));
        }

        if ($request->get('subject_type', null)) {
            $activity->where('subject_type', $request->get('subject_type'));
        }

        if ($request->get('causer_id', null)) {
            $activity->where('causer_id', $request->get('causer_id'));
        }

        if ($request->get('started_at', null)) {
            $activity->where(
                'created_at',
                '>=',
                Carbon::createFromFormat('d-m-Y H:i', $request->get('started_at'))->format('Y-m-d H:i')
            );
        }

        if ($request->get('end_at', null)) {
            $activity->where(
                'created_at',
                '<=',
                Carbon::createFromFormat('d-m-Y H:i', $request->get('end_at'))->format('Y-m-d H:i')
            );
        }

        if ($request->get('order_by', null)) {
            if ($request->get('order_by') == self::ORDER_BY_ID) {
                $orderBy = 'id';
            } elseif ($request->get('order_by') == self::ORDER_BY_LOG_NAME) {
                $orderBy = 'log_name';
            } elseif ($request->get('order_by') == self::ORDER_BY_DESCRIPTION) {
                $orderBy = 'description';
            } else {
                $orderBy = 'id';
            }

            if ($request->get('sort_by') == self::SORT_BY_ASC) {
                $sortBy = 'asc';
            } elseif ($request->get('sort_by') == self::SORT_BY_DESC) {
                $sortBy = 'desc';
            } else {
                $sortBy = 'asc';
            }

            $activity->orderBy($orderBy, $sortBy);
        } else {
            $activity->orderBy('id', 'DESC');
        }

        $total = !empty($request->all()) ? $activity->count() : Activity::count();

        $activity->paginate(
            $request->has('per_page') ?
                $request->request->getInt('per_page') :
                Setting::get('pagination_item_per_page', \App\Setting::PAGINATION_ITEM_PER_PAGE)
        );

        $paginator = new LengthAwarePaginator(
            $activity->get(),
            $total,
            ($request->has('per_page') ?
                $request->request->getInt('per_page') :
                Setting::get('pagination_item_per_page', \App\Setting::PAGINATION_ITEM_PER_PAGE)),
            0
        );

        $paginator->setPath(route("admin.activity_log.index"));

        return $paginator;
    }

    /**
     * @param Request $request
     * @param string $modelClass
     * @param string $modelName
     *
     * @return LengthAwarePaginator
     */
    public function getActivitiesByModel(Request $request, string $modelClass, string $modelName): LengthAwarePaginator
    {
        $activity = $this->activity->newQuery();

        $activity->where('subject_type', $modelClass);

        if ($request->get('id', null)) {
            $activity->where('id', $request->get('id'));
        }

        if ($request->request->get('log_name', null)) {
            $activity->where('log_name', 'LIKE', "%{$request->get('log_name')}%");
        }

        if ($request->request->get('description', null)) {
            $activity->where('description', $request->request->getAlpha('description'));
        }

        if ($request->get('subject_id', null)) {
            $activity->where('subject_id', $request->get('subject_id'));
        }

        if ($request->get('causer_id', null)) {
            $activity->where('causer_id', $request->get('causer_id'));
        }

        if ($request->get('started_at', null)) {
            $activity->where(
                'created_at',
                '>=',
                Carbon::createFromFormat('d-m-Y H:i', $request->get('started_at'))->format('Y-m-d H:i')
            );
        }

        if ($request->get('end_at', null)) {
            $activity->where(
                'created_at',
                '<=',
                Carbon::createFromFormat('d-m-Y H:i', $request->get('end_at'))->format('Y-m-d H:i')
            );
        }

        if ($request->get('order_by', null)) {
            if ($request->get('order_by') == self::ORDER_BY_ID) {
                $orderBy = 'id';
            } elseif ($request->get('order_by') == self::ORDER_BY_LOG_NAME) {
                $orderBy = 'log_name';
            } elseif ($request->get('order_by') == self::ORDER_BY_DESCRIPTION) {
                $orderBy = 'description';
            } else {
                $orderBy = 'id';
            }

            if ($request->get('sort_by') == self::SORT_BY_ASC) {
                $sortBy = 'asc';
            } elseif ($request->get('sort_by') == self::SORT_BY_DESC) {
                $sortBy = 'desc';
            } else {
                $sortBy = 'asc';
            }

            $activity->orderBy($orderBy, $sortBy);
        }

        $total = !empty($request->all()) ? $activity->count() : $activity->where('subject_type', $modelClass)->count();

        $activity->paginate(
            $request->has('per_page') ?
                $request->request->getInt('per_page') :
                Setting::get('pagination_item_per_page', \App\Setting::PAGINATION_ITEM_PER_PAGE)
        );

        $paginator = new LengthAwarePaginator(
            $activity->get(),
            $total,
            ($request->has('per_page') ?
                $request->request->getInt('per_page') :
                Setting::get('pagination_item_per_page', \App\Setting::PAGINATION_ITEM_PER_PAGE)),
            0
        );

        $paginator->setPath(route("admin.{$modelName}s.histories"));

        return $paginator;
    }

    /**
     * @return Collection
     */
    public function getAllSubjectsFromActivityLog():Collection
    {
        return $this->activity
            ->select(DB::raw("substr(subject_type, 5) AS name"), 'subject_type')
            ->get()
            ->pluck('name', 'subject_type');
    }
}
