<?php

namespace App\Repositories;

use App\MenuType;
use Illuminate\Support\Collection;

class MenuTypeRepository extends BaseRepository
{
    /**
     * @var MenuType
     */
    protected $menuType;

    /**
     * @param MenuType $menuType
     */
    public function __construct(MenuType $menuType)
    {
        parent::__construct($menuType);

        $this->menuType = $menuType;
    }

    /**
     * @return Collection
     */
    public function pluckAllMenuTypes(): Collection
    {
        return $this->menuType
            ->orderBy('order')
            ->pluck('translation_key', 'id');
    }
}
