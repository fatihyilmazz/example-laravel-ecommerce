<?php

use App\SystemType;
use Illuminate\Database\Seeder;

class SystemTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system_types')->delete();

        $systemTypes = [
            [
                'id' => SystemType::ID_ECOMMERCE,
                'name' => 'E-Commerce',
                'is_active' => true,
            ],[
                'id' => SystemType::ID_CORPORATE,
                'name' => 'Corporate',
                'is_active' => false,
            ],[
                'id' => SystemType::ID_NEWS,
                'name' => 'NEWS',
                'is_active' => false,
            ],[
                'id' => SystemType::ID_PROPERTY,
                'name' => 'Property',
                'is_active' => false,
            ],[
                'id' => SystemType::ID_CAR,
                'name' => 'Car',
                'is_active' => false,
            ],
        ];

        SystemType::insert($systemTypes);
    }
}
