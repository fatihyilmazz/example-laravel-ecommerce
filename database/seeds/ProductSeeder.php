<?php

use App\ProductType;
use App\TaxRate;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();

        $products = [];
        $productTranslations = [];
        $productCategories = [];

        //array_push($products, ['id' => 1, 'type_id' => ProductType::ID_BASIC, 'brand_id' => 4, 'currency_id' => 1, 'quantity' => 50, 'is_tax_included' => false, 'selling_price' => 100, 'list_price' => 110, 'cost_price' => 90, 'weight' => 1, 'width' => 1, 'height' => 1, 'length' => 1, 'supplier_id' => 1, 'min_selling_quantity' => 1, 'max_selling_quantity' => 5, 'sku' => 'SKU-1', 'gtin' => 'GTIN-1', 'upc' => 'UPC-1', 'ean' => 'EAN-1', 'jan' => 'JAN-1', 'isbn' => 'ISBN-1', 'itf_14' => 'ITF-1', 'mpn' => 'MPN-1', 'oem' => 'OEM-1', 'non_oem' => 'nonOEM-1', 'row' => 1, 'is_active' => true, 'created_at' => Carbon::now()]);
        array_push($products, ['id' => 1, 'brand_id' => 4, 'currency_id' => 1, 'tax_rate_id' => TaxRate::ID_EIGHTEEN_PERCENT, 'is_tax_included' => false, 'selling_price' => 100, 'sku' => 'SKU-1', 'gtin' => 'GTIN-1', 'upc' => 'UPC-1', 'ean' => 'EAN-1', 'jan' => 'JAN-1', 'isbn' => 'ISBN-1', 'itf_14' => 'ITF-1', 'mpn' => 'MPN-1', 'oem' => 'OEM-1', 'non_oem' => 'nonOEM-1', 'row' => 1, 'is_active' => true, 'created_at' => Carbon::now()]);

        array_push($productTranslations, ['product_id' => 1, 'locale' => 'tr', 'name' => 'Oyun Bilgisayarı', 'slug' => 'oyun-bilgisayari', 'short_description' => 'Kısa Açıklama: En iyi oyun bilgisayarı', 'content' => 'Ürün içeriği',  'metas' => null], ['product_id' => 1, 'locale' => 'en', 'name' => 'Gaming Computer', 'slug' => 'gamin-computer', 'short_description' => 'Shot Description: Best gamin computer', 'content' => 'Product content',  'metas' => null]);
        array_push($productCategories, ['product_id' => 1, 'category_id' => 4, 'is_main' => true, 'created_at' => Carbon::now()], ['product_id' => 1, 'category_id' => 2, 'is_main' => false, 'created_at' => Carbon::now()], ['product_id' => 1, 'category_id' => 3, 'is_main' => false, 'created_at' => Carbon::now()]);

        DB::table('products')->insert($products);
        DB::table('product_translations')->insert($productTranslations);
        DB::table('product_categories')->insert($productCategories);
    }
}
