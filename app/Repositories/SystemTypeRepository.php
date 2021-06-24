<?php

namespace App\Repositories;

use App\SystemType;

class SystemTypeRepository extends BaseRepository
{
    /**
     * @var SystemType
     */
    protected $systemType;

    /**
     * @param SystemType $systemType
     */
    public function __construct(SystemType $systemType)
    {
        parent::__construct($systemType);

        $this->systemType = $systemType;
    }
}
