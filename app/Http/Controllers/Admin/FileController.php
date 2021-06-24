<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Setting;
use App\Http\Requests\Admin\FileDownload;
use App\Media;
use App\Rules\Base64;
use App\Rules\Base64MaxSize;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

class FileController extends BaseController
{
    /**
     * @var FileService
     */
    protected $fileService;

    /**
     * @param FileService $fileService
     */
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImageFile(Request $request): \Illuminate\Http\JsonResponse
    {
        $imageMaxSize = Setting::get('image_max_size', \App\Setting::DEFAULT_MAX_SIZE);

        $validator = \Validator::make($request->all(), [
            'image' => [
                'bail',
                'required',
                new Base64MaxSize($imageMaxSize),
                new Base64(['image/jpeg', 'image/png', 'image/webp']),
            ],
            'path' => [
                'bail',
                'required',
                'max:255',
                Rule::in([
                    Media::DEFAULT_IMAGE_PATH_PAGE,
                    Media::DEFAULT_IMAGE_PATH_PRODUCT,
                ])
            ],
        ]);

        if (!$validator->fails()) {
            $source = $this->fileService->uploadBase64File(
                env('IMAGE_PATH_PAGE', Media::DEFAULT_IMAGE_PATH_PAGE),
                $request->get('image')
            );

            if (!empty($source)) {
                return response()->json([
                    'success' => true,
                    'data' => [
                        'imageUrl' => asset($source),
                    ]
                ]);
            }
        }

        foreach ($validator->errors()->toArray() as $key => $value) {
            $errors[] = $value[0];
        }

        return response()->json([
            'success' => false,
            'data' => [
                'errors' => $errors ?? [],
            ]
        ]);
    }

    /**
     * @param FileDownload $request
     *
     * @return BinaryFileResponse
     */
    public function download(FileDownload $request): BinaryFileResponse
    {
        $request->validated();

        $path = null;
        if ($request->get('path') == Media::TYPE_ID_FILE) {
            $path = sprintf('%s%s', env('FILE_PATH_PRODUCT', Media::DEFAULT_FILE_PATH_PRODUCT), $request->get('path'));
        }

        $isExists = File::exists($path);

        if (!$isExists) {
            Log::error(sprintf('[%s][%s] File not found. File path: %s', __CLASS__, __FUNCTION__, $request->get('path')), [
                'userId' => Auth::user()->id,
            ]);

            abort(Response::HTTP_NOT_FOUND);
        }

        return response()->download(
            $path,
            sprintf('%s.%s', $request->get('name'), last(explode('.', $request->get('path'))))
        );
    }
}
