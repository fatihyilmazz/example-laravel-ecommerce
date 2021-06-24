<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('settings')->delete();

        $settingArray = [
            'pagination' => [
                // Item number for per pages
                'item_per_page' => Setting::PAGINATION_ITEM_PER_PAGE,

                // Item number list for per pages
                'per_page_list' => Setting::PAGINATION_PER_PAGE_LIST,
            ],

            'file' => [
                'product' => [
                    'max_size' => Setting::FILE_PRODUCT_MAX_SIZE,
                    'allowed_file_types' => json_encode([
                        'value' => Setting::FILE_PRODUCT_ALLOWED_FILE_TYPES,
                        'options' => Setting::FILE_PRODUCT_ALLOWED_FILE_TYPES,
                    ]),
                ],

            ],

            'image' => [
                //'use_webp' => true,
                'max_size' => Setting::DEFAULT_MAX_SIZE,
                'slider' => [
                    'max_size' => Setting::IMAGE_SLIDER_MAX_SIZE,
                    'width' => Setting::IMAGE_SLIDER_WIDTH,
                    'height' => Setting::IMAGE_SLIDER_HEIGHT,
                ],
                'product' => [
                    'max_size' => Setting::IMAGE_PRODUCT_MAX_SIZE,
                    'width' => Setting::IMAGE_PRODUCT_WIDTH,
                    'height' => Setting::IMAGE_PRODUCT_HEIGHT,
                ],
            ],

            'security' => [
                'password'=> [
                    'length' => Setting::SECURITY_PASSWORD_LENGTH,
                ],
            ],

            'general' => [
                'common' => [
                    'base_url' => 'http://127.0.0.1:8000',
                ],
                'contact' => [
                    'phone' => '00000000000',
                    'cell_phone' => '00000000000',
                    'fax' => '00000000000',
                    'address' => 'Client Address',
                    'e_mail' => 'client@client.com',
                ],
                'tags' => [
                    'google_analytics' => '',
                    'head_tags' => '',
                    'body_tags' => '',
                    'footer_tags' => '',
                ],
                'social_media' => [
                    'facebook' => 'https://www.facebook.com',
                    'instagram' => 'https://www.instagram.com',
                    'twitter' => 'https://www.twitter.com',
                    'youtube' => 'https://www.youtube.com',
                ],
                'seo' => [
                    'title' => 'Website Title',
                    'description' => 'Website Description',
                    'keywords' => 'website, keywords, seo',
                ],
            ],

            'theme' => [
                'path' => 'canvas',
            ],
        ];

        $settingDotArray = Arr::dot($settingArray);

        foreach ($settingDotArray as $key => $value) {
            if (strpos($value, '{') === 0) {
                $dataArray = json_decode($settingDotArray['file.product.allowed_file_types'], true);

                if (is_array($dataArray)) {
                    Setting::create([
                        'key'       => str_replace('.', '_', $key),
                        'value'     => $dataArray['value'],
                        'options'   => explode(',', $dataArray['options']),
                    ]);
                }
            } else {
                Setting::create([
                    'key'       => str_replace('.', '_', $key),
                    'value'     => $value,
                ]);
            }
        }
    }
}
