<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;

class HomeController extends BaseController
{
    /**
     * @return View
     */
    public function __invoke(): View
    {
        return view('admin.index');
    }
}
