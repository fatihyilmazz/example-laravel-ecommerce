<?php

namespace App\Http\Controllers\Admin;

use App\Services\SlugService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;

class SlugController extends BaseController
{
    /**
     * @var SlugService
     */
    protected $slugService;

    /**
     * @param SlugService $slugService
     */
    public function __construct(SlugService $slugService)
    {
        $this->slugService = $slugService;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function generate(Request $request): JsonResponse
    {
        $validator = \Validator::make($request->all(), [
            'slug_type' => [
                'required',
                Rule::in(array_column(SlugService::SLUGGABLE_MODELS, 'model'))
            ],
            'locale'    => 'required|string|max:255',
            'string'    => 'required|string|max:255',
            'recordId'  => 'nullable|numeric'
        ]);

        if ($validator->passes()) {
            $slug = $this->slugService->get(
                $validator->validated()['slug_type'],
                $validator->validated()['locale'],
                $validator->validated()['string'],
                $validator->validated()['recordId']
            );

            return Response::json([
                'success' => true,
                'slug' => $slug,
            ]);
        }

        return Response::json([
            'success' => false,
            'errors' => $validator->errors(),
        ]);
    }
}
