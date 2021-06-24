<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\FilterActivityLog;
use App\Services\ActivityLogService;
use App\Services\AdminService;
use Illuminate\Contracts\View\View;

class ActivityLogController extends BaseController
{
    /**
     * @var ActivityLogService
     */
    protected $activityLogService;

    /**
     * @param ActivityLogService $activityLogService
     */
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->activityLogService = $activityLogService;
    }

    /**
     * @param FilterActivityLog $request
     * @param AdminService $adminService
     *
     * @return View
     */
    public function index(FilterActivityLog $request, AdminService $adminService): View
    {
        $request->validated();

        $activities     = $this->activityLogService->getActivitiesByFilter($request);
        $subjectTypes   = $this->activityLogService->getAllSubjectsFromActivityLog()->toArray();
        $causers        = $adminService->getAllPanelAdminsIdAndNameWithTrashed()->toArray();

        return view('admin.activity_log.index')
            ->with(compact('activities', 'subjectTypes', 'causers'));
    }
}
