<?php

namespace App\Http\Controllers\Web;

use App\Page;
use App\Services\PageService;
use Illuminate\Contracts\View\View;
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
        parent::__construct();

        $this->pageService = $pageService;
    }

    /**
     * @param string $slug
     *
     * @return View
     */
    public function __invoke(string $slug): View
    {
        $page = $this->pageService->getPageBySlug($slug);

        if (!($page instanceof Page)) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return view($this->generateView('page.index'))
            ->with(compact('page'));
    }
}
