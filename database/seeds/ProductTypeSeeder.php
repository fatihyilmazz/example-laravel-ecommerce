<?php

use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_types')->delete();

        $productTypes = [];
        $productTypeTranslations = [];

        array_push($productTypes, ['id' => \App\ProductType::ID_BASIC, 'is_active' => true]);
        array_push($productTypeTranslations, ['product_type_id' => \App\ProductType::ID_BASIC, 'locale' => 'tr', 'name' => 'Varsayılan'],
            ['product_type_id' => \App\ProductType::ID_BASIC, 'locale' => 'en', 'name' => 'Default']);

        \App\ProductType::insert($productTypes);
        \App\ProductTypeTranslation::insert($productTypeTranslations);
    }
}
