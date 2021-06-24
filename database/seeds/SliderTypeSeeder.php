<?php

use App\SliderType;
use Illuminate\Database\Seeder;

class SliderTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('slider_types')->delete();

        $sliderTypes = [
            [
                'id' => SliderType::ID_TYPE_PAGE,
                'translation_key' => 'page',
            ],[
                'id' => SliderType::ID_TYPE_LINK,
                'translation_key' => 'link',
            ],[
                'id' => SliderType::ID_TYPE_CATEGORY,
                'translation_key' => 'category',
            ],[
                'id' => SliderType::ID_TYPE_BRAND,
                'translation_key' => 'brand',
            ],
        ];

        SliderType::insert($sliderTypes);
    }
}
