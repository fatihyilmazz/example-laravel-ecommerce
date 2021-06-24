<?php

use App\Menu;
use App\MenuGroup;
use App\MenuTranslation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('menus')->delete();

        //$electronicMenu = ['id' => 1, 'menu_group_id' => 1, 'parent_id' => null, 'order' => 1, 'is_active' => true, 'created_at' => Carbon::now(), 'deleted_at' => null];
//
        //$electronicMenuTranslation = [
        //    new MenuTranslation(['id' => 1, 'locale' => 'tr', 'name' => 'Elektronik', 'slug' => 'elektronik']),
        //    new MenuTranslation(['id' => 2, 'locale' => 'en', 'name' => 'Electronic', 'slug' => 'electronic']),
        //];
//
        //$electronicMenu = Menu::create($electronicMenu);
        //$electronicMenu->translations()->saveMany($electronicMenuTranslation);
//
        //$computerMenu = ['id' => 2, 'menu_group_id' => 1, 'parent_id' => $electronicMenu->id, 'order' => 2, 'is_active' => true, 'created_at' => Carbon::now(), 'deleted_at' => null];
//
        //$computerMenuTranslation = [
        //    new MenuTranslation(['id' => 3, 'locale' => 'tr', 'name' => 'Bilgisayar', 'slug' => 'bilgisayar']),
        //    new MenuTranslation(['id' => 4, 'locale' => 'en', 'name' => 'Computer', 'slug' => 'computer']),
        //];
//
        //$computerMenu = Menu::create($computerMenu);
        //$computerMenu->translations()->saveMany($computerMenuTranslation);
//
        //$desktopMenu = ['id' => 3, 'menu_group_id' => 1, 'parent_id' => $computerMenu->id, 'order' => 3, 'is_active' => true, 'created_at' => Carbon::now(), 'deleted_at' => null];
//
        //$desktopMenuTranslation = [
        //    new MenuTranslation(['id' => 5, 'locale' => 'tr', 'name' => 'Masaüstü Bilgisayar', 'slug' => 'masaustu-bilgisayar']),
        //    new MenuTranslation(['id' => 6, 'locale' => 'en', 'name' => 'Desktop Computer', 'slug' => 'desktop-computer']),
        //];
//
        //$desktopMenu = Menu::create($desktopMenu);
        //$desktopMenu->translations()->saveMany($desktopMenuTranslation);
//
        //$laptopMenu = ['id' => 4, 'menu_group_id' => 1, 'parent_id' => $computerMenu->id, 'order' => 4, 'is_active' => true, 'created_at' => Carbon::now(), 'deleted_at' => null];
//
        //$laptopMenuTranslation = [
        //    new MenuTranslation(['id' => 7, 'locale' => 'tr', 'name' => 'Dizüstü Bilgisayar', 'slug' => 'dizustu-bilgisayar']),
        //    new MenuTranslation(['id' => 8, 'locale' => 'en', 'name' => 'Laptop Computer', 'slug' => 'laptop-computer']),
        //];
//
        //$laptopMenu = Menu::create($laptopMenu);
        //$laptopMenu->translations()->saveMany($laptopMenuTranslation);
    }
}
