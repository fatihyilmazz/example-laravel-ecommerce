<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->delete();

        $suppliers = [
            ['name' => 'Amazon', 'is_active' => true, 'created_at' => Carbon::now()],
            ['name' => 'Ali Express', 'is_active' => true, 'created_at' => Carbon::now()],
            ['name' => 'Best Buy', 'is_active' => true, 'created_at' => Carbon::now()],
        ];

        DB::table('suppliers')->insert($suppliers);
    }
}
