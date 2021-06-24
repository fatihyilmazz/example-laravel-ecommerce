<?php

namespace App\Services;

use Cocur\Slugify\Slugify;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SlugService
{
    public const SLUGGABLE_MODELS = [
        ['model' => 'category', 'table' => 'category_translations'],
        ['model' => 'menu', 'table' => 'menu_translations'],
        ['model' => 'product', 'table' => 'product_translations'],
    ];

    /**
     * @var string
     */
    protected $separator = '-';

    /**
     * @param string $type
     * @param string $locale
     * @param string $string
     * @param int|null $id
     *
     * @return string
     */
    public function get(string $type, string $locale, string $string, ?int $id = null): string
    {
        try {
            $table = collect(self::SLUGGABLE_MODELS)->firstWhere('model', $type)['table'];

            $slug = $this->generate($string);

            $slugs = $this->find($table, $locale, $slug, $id);

            if (empty($slugs)) {
                return $slug;
            }

            $slug = $this->generateSlugFromSimilar($slug, $slugs);

            if (!empty($slug)) {
                return $slug;
            }
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'type'      => $type,
                'locale'    => $locale,
                'string'    => $string,
                'id'        => $id,
            ]);
        }

        return '';
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public function generate(string $string): string
    {
        $slugify = new Slugify();
        $slugify->activateRuleSet('default');

        return $slugify->slugify($string, $this->separator);
    }

    /**
     * @param string $table
     * @param string $locale
     * @param string $slug
     * @param int $id
     *
     * @return Collection|null
     */
    public function find(string $table, string $locale, string $slug, ?int $id = null): ?Collection
    {
        try {
            $query = DB::table($table);

            if (!empty($id)) {
                $query->where('id', '!=', $id);
            }

            $slugs = $query
                ->where('locale', $locale)
                ->where(function (Builder $query) use ($locale, $slug) {
                    $query->where('slug', $slug)
                        ->orWhere('slug', 'LIKE', $slug . $this->separator . '%')
                        ->where('slug', 'NOT LIKE', $slug . $this->separator . '%' . $this->separator . '%');
                })
                ->get(['slug']);

            if ($slugs->count() == 0) {
                return null;
            }

            $isSlugExists = false;
            foreach ($slugs as $registeredSlug) {
                if ($registeredSlug->slug == $slug) {
                    $isSlugExists = true;
                }
            }

            if (!$isSlugExists) {
                return null;
            }

            return $slugs;
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'table'     => $table,
                'locale'    => $locale,
                'slug'      => $slug,
                'id'        => $id,
            ]);
        }

        return null;
    }

    /**
     * @param string $slug
     * @param Collection $slugs
     *
     * @return string|null
     */
    public function generateSlugFromSimilar(string $slug, Collection $slugs): ?string
    {
        try {
            $slugNumber = $slugs->count();

            do {
                $isExists = false;

                $newSlug = $slug . $this->separator . ($slugNumber++);

                if (strlen($newSlug) <= 255) {
                    foreach ($slugs as $registeredSlug) {
                        if ($registeredSlug->slug == $newSlug) {
                            $isExists = true;
                        }
                    }

                    if (!$isExists) {
                        return $newSlug;
                    }
                } else {
                    $slugArray = explode('-', $slug);

                    $slugSlice = array_slice($slugArray, 0, -1);

                    $slug = implode('-', $slugSlice);
                }
            } while ($isExists);
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'slug' => $slug,
                'slugs' => $slugs->toJson(),
            ]);
        }

        return null;
    }
}
