<?php

use App\Category;
use App\CategoryTranslation;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();
        DB::table('category_translations')->delete();


        $categories = [];
        $categoryTranslations = [];

        array_push($categories, ['id' => 1, 'parent_id' => null, 'order' => null, 'is_active' => true, 'created_at' => Carbon::now()]);
        array_push($categoryTranslations, ['category_id' => 1, 'locale' => 'tr', 'name' => 'Elektronik', 'slug' => 'elektronik', 'metas' => null], ['category_id' => 1, 'locale' => 'en', 'name' => 'Electronic', 'slug' => 'electronic', 'metas' => null]);

        array_push($categories, ['id' => 2, 'parent_id' => 1, 'order' => null, 'is_active' => true, 'created_at' => Carbon::now()]);
        array_push($categoryTranslations, ['category_id' => 2, 'locale' => 'tr', 'name' => 'Bilgisayar', 'slug' => 'bilgisayar', 'metas' => null], ['category_id' => 2, 'locale' => 'en', 'name' => 'Computer', 'slug' => 'computer', 'metas' => null]);

        array_push($categories, ['id' => 3, 'parent_id' => 2, 'order' => null, 'is_active' => true, 'created_at' => Carbon::now()]);
        array_push($categoryTranslations, ['category_id' => 3, 'locale' => 'tr', 'name' => 'Masaüstü Bilgisayar', 'slug' => 'masaustu-bilgisayar', 'metas' => null], ['category_id' => 3, 'locale' => 'en', 'name' => 'Desktop Computer', 'slug' => 'desktop-computer', 'metas' => null]);

        array_push($categories, ['id' => 4, 'parent_id' => 2, 'order' => null, 'is_active' => true, 'created_at' => Carbon::now()]);
        array_push($categoryTranslations, ['category_id' => 4, 'locale' => 'tr', 'name' => 'Oyun Bilgisayarı', 'slug' => 'oyun-bilgisayari', 'metas' => null], ['category_id' => 4, 'locale' => 'en', 'name' => 'Gaming Computer', 'slug' => 'gaming-computer', 'metas' => null]);

        array_push($categories, ['id' => 5, 'parent_id' => 2, 'order' => null, 'is_active' => true, 'created_at' => Carbon::now()]);
        array_push($categoryTranslations, ['category_id' => 5, 'locale' => 'tr', 'name' => 'Dizüstü Bilgisayar', 'slug' => 'dizustu-bilgisayar', 'metas' => null], ['category_id' => 5, 'locale' => 'en', 'name' => 'Laptop Computer', 'slug' => 'laptop-computer', 'metas' => null]);

        DB::table('categories')->insert($categories);
        DB::table('category_translations')->insert($categoryTranslations);
    }
}
