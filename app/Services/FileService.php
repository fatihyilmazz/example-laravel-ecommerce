<?php

namespace App\Services;

use App\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;

class FileService
{
    /**
     * @param string $path
     * @param string $fileName
     * @param UploadedFile $file
     *
     * @return string|null
     */
    public function upload(string $path, string $fileName, UploadedFile $file): ?string
    {
        try {
            $fileName = $fileName. '_'. rand(000, 999). '.'. $file->getClientOriginalExtension();

            $file = $file->move($path, $fileName);

            if ($file instanceof File) {
                return $fileName;
            }
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'path'      => $path,
                'fileName'  => $fileName,
                'file'      => (array)$file,
            ]);
        }

        return null;
    }

    /**
     * @param string $path
     * @param string $base64String
     *
     * @return string|null
     */
    public function uploadBase64File(string $path, string $base64String): ?string
    {
        try {
            $image = base64_decode($base64String);

            $info = getimagesizefromstring($image);

            $name = uniqid(). '.'. explode('/', $info['mime'])[1];

            $fileName = public_path(env('PAGE_IMAGE_PATH', Media::DEFAULT_IMAGE_PATH_PAGE)). $name;

            $uploadResult = file_put_contents($fileName, $image);

            if (is_int($uploadResult)) {
                return $path. $name;
            }
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception), [
                'path'          => $path,
                'base64String'  => $base64String,
            ]);
        }

        return null;
    }

    /**
     * @return array|null
     */
    public function getWebStaticPagesNames(): ?array
    {
        try {
            $staticPages = Storage::disk('views')->files('web/steel/static_pages');

            $pageNamesAndTranslationKey = Collection::make();

            foreach ($staticPages as $staticPage) {
                $pageNameGroup = explode('/', $staticPage)[3];
                $pageNameGroup = explode('.', $pageNameGroup)[0];

                $pageName = explode('.', $pageNameGroup)[0];

                $translationKey = str_replace('-', '_', $pageName);

                $pageName = str_replace('-', '_', $pageName);

                $pageNamesAndTranslationKey->add([
                    'name' => $pageName,
                    'translationKey' => $translationKey,
                ]);
            }

            $staticPageNames = [];
            foreach ($pageNamesAndTranslationKey as $webStaticPageName) {
                $staticPageNames[$webStaticPageName['name']] = __('text.static_page.' . $webStaticPageName['translationKey']);

            }

            return $staticPageNames;
        } catch (\Throwable $exception) {
            Log::error(sprintf('[%s][%s] %s', __CLASS__, __FUNCTION__, $exception));
        }

        return null;
    }
}
