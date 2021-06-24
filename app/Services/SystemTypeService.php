<?php

namespace App\Services;

use App\Repositories\SystemTypeRepository;
use App\Repositories\UserRepository;

class SystemTypeService
{
    /**
     * @var UserRepository
     */
    protected $systemTypeRepository;

    /**
     * @param SystemTypeRepository $systemTypeRepository
     */
    public function __construct(SystemTypeRepository $systemTypeRepository)
    {
        $this->systemTypeRepository = $systemTypeRepository;
    }
}
