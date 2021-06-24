<?php

use App\Page;
use App\PageTranslation;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->delete();

        $pages = [
            'id' => 1, 'name' => 'Deneme Sayfası', 'is_published' => true, 'created_at' => now(), 'updated_at' => now()
        ];

        $pageTranslations = [
             [
                 'id' => 1,
                 'page_id' => 1,
                 'locale' => 'tr',
                 'content' => 'Sayfa içeriği',
                 'slug' => 'hakkimizda',
                 'metas' => ['title' => 'Hakkımızda', 'description' => 'Deneme Sayfası Açıklama', 'keywords' => 'deneme,sayfası']
             ],
             [
                 'id' => 2,
                 'page_id' => 1,
                 'locale' => 'en',
                 'content' => 'Page Content',
                 'slug' => 'about-us',
                 'metas' => ['title' => 'About Us', 'description' => 'About Us Description', 'keywords' => 'about us, page']
             ],
        ];

        Page::create($pages);

        foreach ($pageTranslations as $pageTranslation) {
            PageTranslation::create($pageTranslation);
        }
    }
}
