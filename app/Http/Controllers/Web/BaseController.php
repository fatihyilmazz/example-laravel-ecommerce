<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

abstract class BaseController extends Controller
{
    /**
     * @var string
     */
    protected $themePath;

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        $this->themePath = setting('theme_path', 'steel');
    }

    /**
     * @param string $filePathAndName
     *
     * @return string
     */
    public function generateView(string $filePathAndName): string
    {
        return sprintf('%s.%s.%s', 'web', $this->themePath, $filePathAndName);
    }
}
