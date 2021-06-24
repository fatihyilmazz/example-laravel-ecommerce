<?php

use App\Brand;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->delete();

        $brands = [
            [
                'id' => 1,
                'name' => 'Apple',
                'order' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'deleted_at' => null,
            ],[
                'id' => 2,
                'name' => 'Samsung',
                'order' => 2,
                'is_active' => false,
                'created_at' => Carbon::now(),
                'deleted_at' => null,
            ],[
                'id' => 3,
                'name' => 'MSI',
                'order' => 3,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'deleted_at' => null,
            ],[
                'id' => 4,
                'name' => 'Dell',
                'order' => 4,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'deleted_at' => null,
            ]
        ];

        Brand::insert($brands);
    }
}
