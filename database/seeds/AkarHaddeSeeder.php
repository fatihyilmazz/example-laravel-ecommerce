<?php

use Carbon\Carbon;
use App\Menu;
use App\MenuTranslation;
use Illuminate\Database\Seeder;

class AkarHaddeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // DB::table('menus')->delete();
       // DB::table('menu_translations')->delete();

        $menus = [
            [
                'id' =>1,
                'menu_group_id' => 1,
                'parent_id' => null,
                'menu_type_id' => 1,
                'value' => null,
                'row' => 1,
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => 1,

            ],
            [
                'id' =>2,
                'menu_group_id' => 1,
                'parent_id' => null,
                'menu_type_id' => null,
                'value' => null,
                'row' => 2,
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,

            ],
            [
                'id' => 3,
                'menu_group_id' => 1,
                'parent_id' => 2,
                'menu_type_id' => 2,
                'value' => ["1"],
                'row' => 1,
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,

            ],
            [
                'id' => 4,
                'menu_group_id' => 1,
                'parent_id' => null,
                'menu_type_id' => null,
                'value' => null,
                'row' => 3,
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,

            ],
            [
                'id' => 5,
                'menu_group_id' => 1,
                'parent_id' => 4,
                'menu_type_id' => 4,
                'value' => ["1"],
                'row' => 1,
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,

            ],
            [
                'id' => 6,
                'menu_group_id' => 1,
                'parent_id' => null,
                'menu_type_id' => 7,
                'value' => ["contact"],
                'row' => 4,
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,

            ],
            [
                'id' => 7,
                'menu_group_id' => 1,
                'parent_id' => 2,
                'menu_type_id' => 2,
                'value' => ["2"],
                'row' => 3,
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,

            ],
            [
                'id' => 8,
                'menu_group_id' => 1,
                'parent_id' => 2,
                'menu_type_id' => 2,
                'value' => ["3"],
                'row' => 2,
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,

            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
