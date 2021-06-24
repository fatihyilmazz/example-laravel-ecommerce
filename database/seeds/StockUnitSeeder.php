<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StockUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stock_units')->delete();

        $stockUnits = [];
        $stockUnitTranslations = [];

        array_push($stockUnits, ['id' => 1, 'parent_id' => null, 'coefficient' => null, 'code' => null, 'universal_code' => null, 'order' => null, 'is_active' => true, 'created_at' => Carbon::now()]);
        array_push($stockUnitTranslations, ['stock_unit_id' => 1, 'locale' => 'tr', 'name' => 'Adet'], ['stock_unit_id' => 1, 'locale' => 'en', 'name' => 'Piece']);

        array_push($stockUnits, ['id' => 2, 'parent_id' => 1, 'coefficient' => 1, 'code' => null, 'universal_code' => null, 'order' => null, 'is_active' => true, 'created_at' => Carbon::now()]);
        array_push($stockUnitTranslations, ['stock_unit_id' => 2, 'locale' => 'tr', 'name' => 'Paket'], ['stock_unit_id' => 2, 'locale' => 'en', 'name' => 'Package']);

        array_push($stockUnits, ['id' => 3, 'parent_id' => 2, 'coefficient' => 1, 'code' => null, 'universal_code' => null, 'order' => null, 'is_active' => true, 'created_at' => Carbon::now()]);
        array_push($stockUnitTranslations, ['stock_unit_id' => 3, 'locale' => 'tr', 'name' => 'Kutu'], ['stock_unit_id' => 3, 'locale' => 'en', 'name' => 'Box']);

        DB::table('stock_units')->insert($stockUnits);
        DB::table('stock_unit_translations')->insert($stockUnitTranslations);
    }
}
