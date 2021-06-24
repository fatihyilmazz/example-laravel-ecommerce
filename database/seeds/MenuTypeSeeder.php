<?php

use App\MenuType;
use Illuminate\Database\Seeder;

class MenuTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_types')->delete();

        $menuTypes = [
            [
                'id'                => MenuType::ID_MAIN_PAGE,
                'translation_key'   => 'main_page',
                'order'             => 1,
            ],[
                'id'                => MenuType::ID_PAGE,
                'translation_key'   => 'internal_page',
                'order'             => 2,
            ], [
                'id'                => MenuType::ID_EXTERNAL_LINK,
                'translation_key'   => 'external_link',
                'order'             => 3,
            ],[
                'id'                => MenuType::ID_MAIN_CATEGORY,
                'translation_key'   => 'main_category',
                'order'             => 4,
            ],[
                'id'                => MenuType::ID_SELECTED_CATEGORIES,
                'translation_key'   => 'selected_categories',
                'order'             => 5,
            ],[
                'id'                => MenuType::ID_BRANDS,
                'translation_key'   => 'brands',
                'order'             => 6,
            ],[
                'id'                => MenuType::ID_STATIC_PAGE,
                'translation_key'   => 'static_page',
                'order'             => 7,
            ]
        ];

        MenuType::insert($menuTypes);
    }
}
