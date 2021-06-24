<?php

namespace App\Repositories;

use App\SliderType;
use Illuminate\Support\Collection;

class SliderTypeRepository extends BaseRepository
{
    /**
     * @var SliderType
     */
    protected $sliderType;

    /**
     * @param SliderType $sliderType
     */
    public function __construct(SliderType $sliderType)
    {
        parent::__construct($sliderType);

        $this->sliderType = $sliderType;
    }

    /**
     * @return Collection
     */
    public function pluckAllSliderTypes(): Collection
    {
        return $this->sliderType->orderBy('translation_key', 'ASC')->pluck('translation_key', 'id');
    }
}
