<?php

use App\MenuGroup;
use Illuminate\Database\Seeder;

class MenuGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_groups')->delete();

        $menuGroups = [
            [
                'id' => MenuGroup::ID_HEADER,
                'name' => 'Header Menu',
                'order' => 1,
                'is_active' => true,
                'created_at' => \Carbon\Carbon::now(),
                'deleted_at' => null,
            ], [
                'id' => MenuGroup::ID_FOOTER,
                'name' => 'Footer Menu',
                'order' => 2,
                'is_active' => false,
                'created_at' => \Carbon\Carbon::now(),
                'deleted_at' => null,
            ],
        ];

        MenuGroup::insert($menuGroups);
    }
}
