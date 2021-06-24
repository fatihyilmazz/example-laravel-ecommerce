<?php

namespace App\Repositories;

use App\Locale;
use Illuminate\Support\Collection;

class LocaleRepository extends BaseRepository
{
    /**
     * @var Locale
     */
    protected $locale;

    /**
     * @param Locale $locale
     */
    public function __construct(Locale $locale)
    {
        parent::__construct($locale);

        $this->locale = $locale;
    }

    /**
     * @return Collection
     */
    public function getActiveLocales(): Collection
    {
        return $this->locale->active()->get();
    }
}
