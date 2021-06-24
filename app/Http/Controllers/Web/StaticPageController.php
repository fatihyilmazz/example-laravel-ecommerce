<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Web\Contact;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class StaticPageController extends BaseController
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function contact(Request $request): View
    {
        if ($request->getMethod() == HttpRequest::METHOD_GET) {
            return view($this->generateView('static_pages.contact'));
        }

        $contactFormRequest = new Contact();

        Validator::make($request->all(), $contactFormRequest->rules())->validate();
    }
}
