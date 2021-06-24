<?php

namespace App\Http\Controllers\Web;

use App\Brand;
use Illuminate\Http\Request;

class BrandController extends BaseController
{
    public function index(Brand $brand)
    {
        //dd($brand);
    }
}
