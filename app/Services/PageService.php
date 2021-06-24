<?php

namespace App\Services;

use App\Page;
use App\PageTranslation;
use App\Repositories\PageRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class PageService
{
    /**
     * @var PageRepository
     */
    protected $pageRepository;

    /**
     * @param PageRepository $pageRepository
     */
    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator|null
     */
    public function getPagesByFilter(Request $request): ?LengthAwarePaginator
    {
        try {
            return $this->pageRepository->getPagesByFilter($request);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'request' => $request,
            ]);
        }

        return null;
    }

    /**
     * @param int $pageId
     *
     * @return Page|null
     */
    public function getPageById(int $pageId): ?Page
    {
        try {
            return $this->pageRepository->getPageById($pageId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'pageId' => $pageId,
            ]);
        }

        return null;
    }

    /**
     * @param array $data
     *
     * @return Model|null
     */
    public function createPage(array $data): ?Page
    {
        try {
            return DB::transaction(function () use ($data) {
                $page = $this->pageRepository->create($data);

                $translations = collect();
                foreach ($data['translations'] as $translation) {
                    if (!empty($translation['keywords'])) {
                        $translation['metas']['keywords'] = $translation['keywords'];

                        unset($translation['keywords']);
                    }

                    if (!empty($translation['description'])) {
                        $translation['metas']['description'] = $translation['description'];

                        unset($translation['description']);
                    }

                    $translations->push(new PageTranslation($translation));
                }

                $page->translations()->saveMany($translations);

                return $page;
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
     * @param int $pageId
     *
     * @return bool|null
     */
    public function updatePage(array $data, int $pageId): ?bool
    {
        try {
            return DB::transaction(function () use ($data, $pageId) {
                $page = $this->pageRepository->find($pageId);

                $page->update($data);

                $translations = collect();
                foreach ($data['translations'] as $translation) {
                    if (isset($translation['id'])) {
                        $page->translations()->find($translation['id'])->update($translation);
                    } else {
                        $translations->push(new PageTranslation($translation));
                    }
                }

                if ($translations->isNotEmpty()) {
                    $page->translations()->saveMany($translations);
                }

                return true;
            });
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'data'      => $data,
                'pageId'    => $pageId,
            ]);
        }

        return null;
    }

    /**
     * @param int $pageId
     *
     * @return bool|null
     */
    public function destroyPage(int $pageId): ?bool
    {
        try {
            return $this->pageRepository->destroy($pageId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'pageId' => $pageId,
            ]);
        }

        return null;
    }

    /**
     * @return Collection|null
     */
    public function pluckActivePagesIdAndName(): ?Collection
    {
        try {
            return $this->pageRepository->pluckActivePagesIdAndName();
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }

    /**
     * @param int $pageId
     *
     * @return Page|null
     */
    public function getPageWithCurrentLocaleById(int $pageId): ?Page
    {
        try {
            return $this->pageRepository->getPageWithCurrentLocaleById($pageId);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'pageId' => $pageId,
            ]);
        }

        return null;
    }

    /**
     * @param string $slug
     *
     * @return Page|null
     */
    public function getPageBySlug(string $slug): ?Page
    {
        try {
            return $this->pageRepository->getPageBySlug($slug);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'slug' => $slug,
            ]);
        }

        return null;
    }
}
