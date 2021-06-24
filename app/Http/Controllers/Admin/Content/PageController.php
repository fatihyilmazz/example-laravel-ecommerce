<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Content\FilterPage;
use App\Http\Requests\Admin\Content\StorePage;
use App\Page;
use App\Services\LocaleService;
use App\Services\PageService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class PageController extends BaseController
{
    /**
     * @var PageService
     */
    protected $pageService;

    /**
     * @param PageService $pageService
     */
    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    /**
     * @param FilterPage $request
     *
     * @return View
     */
    public function index(FilterPage $request): View
    {
        $request->validated();

        $pages = $this->pageService->getPagesByFilter($request);

        return view('admin.page.index')
            ->with(compact('pages'));
    }

    /**
     * @param LocaleService $localeService
     *
     * @return View
     */
    public function create(LocaleService $localeService): View
    {
        $locales = $localeService->getSupportedLocales();

        return view('admin.page.form')
            ->with(compact('locales'));
    }

    /**
     * @param StorePage $request
     *
     * @return RedirectResponse
     */
    public function store(StorePage $request): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $page = $this->pageService->createPage($validatedAttributes);
        if ($page instanceof Page) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.pages.index'))
                ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
        }

        $notifyStatus   = 'danger';
        $notifyTitle    = __('messages.info.operation.failed');
        $notifyMessage  = __('messages.info.operation.saving_failed');

        return back()->withInput()
            ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
    }

    /**
     * @param int $pageId
     * @param LocaleService $localeService
     *
     * @return View
     */
    public function edit(int $pageId, LocaleService $localeService): View
    {
        $page       = $this->pageService->getPageById($pageId);
        $locales    = $localeService->getSupportedLocales();

        html()->model($page);

        return view('admin.page.form')
            ->with(compact('page', 'locales'));
    }

    /**
     * @param StorePage $request
     * @param int $pageId
     *
     * @return RedirectResponse
     */
    public function update(StorePage $request, int $pageId): RedirectResponse
    {
        $validatedAttributes = $request->validated();

        $updateStatus = $this->pageService->updatePage($validatedAttributes, $pageId);
        if ($updateStatus) {
            $notifyStatus   = 'success';
            $notifyTitle    = __('messages.info.operation.successful');
            $notifyMessage  = __('messages.info.operation.saved');

            return redirect(route('admin.pages.index'))
                ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
        }

        $notifyStatus   = 'danger';
        $notifyTitle    = __('messages.info.operation.failed');
        $notifyMessage  = __('messages.info.operation.saving_failed');

        return back()->withInput()
            ->setStatusCode(Response::HTTP_NOT_FOUND)
            ->with(compact('notifyStatus', 'notifyTitle', 'notifyMessage'));
    }

    /**
     * @param int $pageId
     *
     * @return bool|null
     */
    public function destroy(int $pageId): ?bool
    {
        return $this->pageService->destroyPage($pageId);
    }
}
