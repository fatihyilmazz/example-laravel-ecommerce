<?php

namespace App\Http\Controllers\Web;

use Illuminate\Contracts\View\View;

class HomeController extends BaseController
{
    /**
     * @return View
     */
    public function __invoke(): View
    {
        /**
         * web/steel(aktif tema)/index
         *
         * örnek: dosya yolu web/steel(aktif tema)/users/index için -> users.index yeterli
         */
        return view($this->generateView('index'));
    }
}
