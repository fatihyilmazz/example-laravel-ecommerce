<?php

namespace App\Repositories;

use App\Facades\Setting;
use App\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PageRepository extends BaseRepository
{
    /**
     * @var Page
     */
    protected $page;

    /**
     * @param Page $page
     */
    public function __construct(Page $page)
    {
        parent::__construct($page);

        $this->page = $page;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator
     */
    public function getPagesByFilter(Request $request): LengthAwarePaginator
    {
        $page = $this->page;

        if ($request->has('id') && !empty($request->request->getInt('id'))) {
            $page = $page->where('id', $request->request->getInt('id'));
        }

        if ($request->has('name') && !empty($request->request->get('name'))) {
            $page = $page->where('name', 'LIKE', "%{$request->request->get('name')}%");
        }

        if ($request->has('is_published') && !is_null($request->get('is_published'))) {
            $page = $page->where('is_published', $request->request->getBoolean('is_published'));
        }

        return $page->orderBy('id', 'DESC')
        ->paginate($request->has('per_page') ?
            $request->request->getInt('per_page') :
            Setting::get('pagination_item_per_page', \App\Setting::PAGINATION_ITEM_PER_PAGE))
        ->setPath(route('admin.pages.index'));
    }

    /**
     * @param int $pageId
     *
     * @return Page|Model|null
     */
    public function getPageById(int $pageId): ?Page
    {
        return $this->page
            ->with(['translations'])
            ->find($pageId);
    }

    /**
     * @return Collection
     */
    public function pluckActivePagesIdAndName(): Collection
    {
        return $this->page->published()->orderBy('name', 'ASC')->pluck('name', 'id');
    }

    /**
     * @param int $pageId
     *
     * @return Page|Model|null
     */
    public function getPageWithCurrentLocaleById(int $pageId): ?Page
    {
        return $this->page
            ->with(['translationForCurrentLocale'])
            ->where('id', '=', $pageId)
            ->first();
    }

    /**
     * @param string $slug
     *
     * @return Page|Model|null
     */
    public function getPageBySlug(string $slug): ?Page
    {
        return $this->page
            ->published()
            ->with(['translationForCurrentLocale'])
            ->whereHas('translationForCurrentLocale', function ($query) use ($slug) {
                    $query->where('slug', '=', $slug);
            })
            ->first();
    }
}
