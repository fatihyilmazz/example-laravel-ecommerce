<?php

use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinces')->delete();

        $provinces = [
            ['id' => 1, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 2, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 3, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 4, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 5, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 6, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 7, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 8, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 9, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 10, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 11, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 12, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 13, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 14, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 15, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 16, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 17, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 18, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 19, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 20, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 21, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 22, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 23, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 24, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 25, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 26, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 27, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 28, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 29, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 30, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 31, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 32, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 33, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 34, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 35, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 36, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 37, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 38, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 39, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 40, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 41, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 42, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 43, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 44, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 45, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 46, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 47, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 48, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 49, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 50, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 51, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 52, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 53, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 54, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 55, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 56, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 57, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 58, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 59, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 60, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 61, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 62, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 63, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 64, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 65, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 66, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 67, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 68, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 69, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 70, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 71, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 72, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 73, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 74, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 75, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 76, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 77, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 78, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 79, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 80, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
            ['id' => 81, 'country_id' => \App\Country::ID_TURKEY, 'order' => null, 'is_active' => true, 'created_at' => \Carbon\Carbon::now()],
        ];

        \App\Province::insert($provinces);

        $provinceTranslations = [
            ['province_id' => 1, 'locale' => 'tr', 'name' => 'Adana'],
            ['province_id' => 2, 'locale' => 'tr', 'name' => 'Adıyaman'],
            ['province_id' => 3, 'locale' => 'tr', 'name' => 'Afyonkarahisar'],
            ['province_id' => 4, 'locale' => 'tr', 'name' => 'Ağrı'],
            ['province_id' => 5, 'locale' => 'tr', 'name' => 'Aksaray'],
            ['province_id' => 6, 'locale' => 'tr', 'name' => 'Amasya'],
            ['province_id' => 7, 'locale' => 'tr', 'name' => 'Ankara'],
            ['province_id' => 8, 'locale' => 'tr', 'name' => 'Antalya'],
            ['province_id' => 9, 'locale' => 'tr', 'name' => 'Ardahan'],
            ['province_id' => 10, 'locale' => 'tr','name' => 'Artvin'],
            ['province_id' => 11, 'locale' => 'tr','name' => 'Aydın'],
            ['province_id' => 12, 'locale' => 'tr','name' => 'Balıkesir'],
            ['province_id' => 13, 'locale' => 'tr','name' => 'Bartın'],
            ['province_id' => 14, 'locale' => 'tr','name' => 'Batman'],
            ['province_id' => 15, 'locale' => 'tr','name' => 'Bayburt'],
            ['province_id' => 16, 'locale' => 'tr','name' => 'Bilecik'],
            ['province_id' => 17, 'locale' => 'tr','name' => 'Bingöl'],
            ['province_id' => 18, 'locale' => 'tr','name' => 'Bitlis'],
            ['province_id' => 19, 'locale' => 'tr','name' => 'Bolu'],
            ['province_id' => 20, 'locale' => 'tr','name' => 'Burdur'],
            ['province_id' => 21, 'locale' => 'tr','name' => 'Bursa'],
            ['province_id' => 22, 'locale' => 'tr','name' => 'Çanakkale'],
            ['province_id' => 23, 'locale' => 'tr','name' => 'Çankırı'],
            ['province_id' => 24, 'locale' => 'tr','name' => 'Çorum'],
            ['province_id' => 25, 'locale' => 'tr','name' => 'Denizli'],
            ['province_id' => 26, 'locale' => 'tr','name' => 'Diyarbakır'],
            ['province_id' => 27, 'locale' => 'tr','name' => 'Düzce'],
            ['province_id' => 28, 'locale' => 'tr','name' => 'Edirne'],
            ['province_id' => 29, 'locale' => 'tr','name' => 'Elazığ'],
            ['province_id' => 30, 'locale' => 'tr','name' => 'Erzincan'],
            ['province_id' => 31, 'locale' => 'tr','name' => 'Erzurum'],
            ['province_id' => 32, 'locale' => 'tr','name' => 'Eskişehir'],
            ['province_id' => 33, 'locale' => 'tr','name' => 'Gaziantep'],
            ['province_id' => 34, 'locale' => 'tr','name' => 'Giresun'],
            ['province_id' => 35, 'locale' => 'tr','name' => 'Gümüşhane'],
            ['province_id' => 36, 'locale' => 'tr','name' => 'Hakkari'],
            ['province_id' => 37, 'locale' => 'tr','name' => 'Hatay'],
            ['province_id' => 38, 'locale' => 'tr','name' => 'Iğdır'],
            ['province_id' => 39, 'locale' => 'tr','name' => 'Isparta'],
            ['province_id' => 40, 'locale' => 'tr','name' => 'İstanbul'],
            ['province_id' => 41, 'locale' => 'tr','name' => 'İzmir'],
            ['province_id' => 42, 'locale' => 'tr','name' => 'Kahramanmaraş'],
            ['province_id' => 43, 'locale' => 'tr','name' => 'Karabük'],
            ['province_id' => 44, 'locale' => 'tr','name' => 'Karaman'],
            ['province_id' => 45, 'locale' => 'tr','name' => 'Kars'],
            ['province_id' => 46, 'locale' => 'tr','name' => 'Kastamonu'],
            ['province_id' => 47, 'locale' => 'tr','name' => 'Kayseri'],
            ['province_id' => 48, 'locale' => 'tr','name' => 'Kırıkkale'],
            ['province_id' => 49, 'locale' => 'tr','name' => 'Kırklareli'],
            ['province_id' => 50, 'locale' => 'tr','name' => 'Kırşehir'],
            ['province_id' => 51, 'locale' => 'tr','name' => 'Kilis'],
            ['province_id' => 52, 'locale' => 'tr','name' => 'Kocaeli'],
            ['province_id' => 53, 'locale' => 'tr','name' => 'Konya'],
            ['province_id' => 54, 'locale' => 'tr','name' => 'Kütahya'],
            ['province_id' => 55, 'locale' => 'tr','name' => 'Malatya'],
            ['province_id' => 56, 'locale' => 'tr','name' => 'Manisa'],
            ['province_id' => 57, 'locale' => 'tr','name' => 'Mardin'],
            ['province_id' => 58, 'locale' => 'tr','name' => 'Mersin'],
            ['province_id' => 59, 'locale' => 'tr','name' => 'Muğla'],
            ['province_id' => 60, 'locale' => 'tr','name' => 'Muş'],
            ['province_id' => 61, 'locale' => 'tr','name' => 'Nevşehir'],
            ['province_id' => 62, 'locale' => 'tr','name' => 'Niğde'],
            ['province_id' => 63, 'locale' => 'tr','name' => 'Ordu'],
            ['province_id' => 64, 'locale' => 'tr','name' => 'Osmaniye'],
            ['province_id' => 65, 'locale' => 'tr','name' => 'Rize'],
            ['province_id' => 66, 'locale' => 'tr','name' => 'Sakarya'],
            ['province_id' => 67, 'locale' => 'tr','name' => 'Samsun'],
            ['province_id' => 68, 'locale' => 'tr','name' => 'Siirt'],
            ['province_id' => 69, 'locale' => 'tr','name' => 'Sinop'],
            ['province_id' => 70, 'locale' => 'tr','name' => 'Sivas'],
            ['province_id' => 71, 'locale' => 'tr','name' => 'Şanlıurfa'],
            ['province_id' => 72, 'locale' => 'tr','name' => 'Şırnak'],
            ['province_id' => 73, 'locale' => 'tr','name' => 'Tekirdağ'],
            ['province_id' => 74, 'locale' => 'tr','name' => 'Tokat'],
            ['province_id' => 75, 'locale' => 'tr','name' => 'Trabzon'],
            ['province_id' => 76, 'locale' => 'tr','name' => 'Tunceli'],
            ['province_id' => 77, 'locale' => 'tr','name' => 'Uşak'],
            ['province_id' => 78, 'locale' => 'tr','name' => 'Van'],
            ['province_id' => 79, 'locale' => 'tr','name' => 'Yalova'],
            ['province_id' => 80, 'locale' => 'tr','name' => 'Yozgat'],
            ['province_id' => 81, 'locale' => 'tr','name' => 'Zonguldak'],
        ];

        $provinceTranslationsEn = [
            ['province_id' => 1, 'locale' => 'en', 'name' => 'Adana'],
            ['province_id' => 2, 'locale' => 'en', 'name' => 'Adıyaman'],
            ['province_id' => 3, 'locale' => 'en', 'name' => 'Afyonkarahisar'],
            ['province_id' => 4, 'locale' => 'en', 'name' => 'Ağrı'],
            ['province_id' => 5, 'locale' => 'en', 'name' => 'Aksaray'],
            ['province_id' => 6, 'locale' => 'en', 'name' => 'Amasya'],
            ['province_id' => 7, 'locale' => 'en', 'name' => 'Ankara'],
            ['province_id' => 8, 'locale' => 'en', 'name' => 'Antalya'],
            ['province_id' => 9, 'locale' => 'en', 'name' => 'Ardahan'],
            ['province_id' => 10, 'locale' => 'en','name' => 'Artvin'],
            ['province_id' => 11, 'locale' => 'en','name' => 'Aydın'],
            ['province_id' => 12, 'locale' => 'en','name' => 'Balıkesir'],
            ['province_id' => 13, 'locale' => 'en','name' => 'Bartın'],
            ['province_id' => 14, 'locale' => 'en','name' => 'Batman'],
            ['province_id' => 15, 'locale' => 'en','name' => 'Bayburt'],
            ['province_id' => 16, 'locale' => 'en','name' => 'Bilecik'],
            ['province_id' => 17, 'locale' => 'en','name' => 'Bingöl'],
            ['province_id' => 18, 'locale' => 'en','name' => 'Bitlis'],
            ['province_id' => 19, 'locale' => 'en','name' => 'Bolu'],
            ['province_id' => 20, 'locale' => 'en','name' => 'Burdur'],
            ['province_id' => 21, 'locale' => 'en','name' => 'Bursa'],
            ['province_id' => 22, 'locale' => 'en','name' => 'Çanakkale'],
            ['province_id' => 23, 'locale' => 'en','name' => 'Çankırı'],
            ['province_id' => 24, 'locale' => 'en','name' => 'Çorum'],
            ['province_id' => 25, 'locale' => 'en','name' => 'Denizli'],
            ['province_id' => 26, 'locale' => 'en','name' => 'Diyarbakır'],
            ['province_id' => 27, 'locale' => 'en','name' => 'Düzce'],
            ['province_id' => 28, 'locale' => 'en','name' => 'Edirne'],
            ['province_id' => 29, 'locale' => 'en','name' => 'Elazığ'],
            ['province_id' => 30, 'locale' => 'en','name' => 'Erzincan'],
            ['province_id' => 31, 'locale' => 'en','name' => 'Erzurum'],
            ['province_id' => 32, 'locale' => 'en','name' => 'Eskişehir'],
            ['province_id' => 33, 'locale' => 'en','name' => 'Gaziantep'],
            ['province_id' => 34, 'locale' => 'en','name' => 'Giresun'],
            ['province_id' => 35, 'locale' => 'en','name' => 'Gümüşhane'],
            ['province_id' => 36, 'locale' => 'en','name' => 'Hakkari'],
            ['province_id' => 37, 'locale' => 'en','name' => 'Hatay'],
            ['province_id' => 38, 'locale' => 'en','name' => 'Iğdır'],
            ['province_id' => 39, 'locale' => 'en','name' => 'Isparta'],
            ['province_id' => 40, 'locale' => 'en','name' => 'İstanbul'],
            ['province_id' => 41, 'locale' => 'en','name' => 'İzmir'],
            ['province_id' => 42, 'locale' => 'en','name' => 'Kahramanmaraş'],
            ['province_id' => 43, 'locale' => 'en','name' => 'Karabük'],
            ['province_id' => 44, 'locale' => 'en','name' => 'Karaman'],
            ['province_id' => 45, 'locale' => 'en','name' => 'Kars'],
            ['province_id' => 46, 'locale' => 'en','name' => 'Kastamonu'],
            ['province_id' => 47, 'locale' => 'en','name' => 'Kayseri'],
            ['province_id' => 48, 'locale' => 'en','name' => 'Kırıkkale'],
            ['province_id' => 49, 'locale' => 'en','name' => 'Kırklareli'],
            ['province_id' => 50, 'locale' => 'en','name' => 'Kırşehir'],
            ['province_id' => 51, 'locale' => 'en','name' => 'Kilis'],
            ['province_id' => 52, 'locale' => 'en','name' => 'Kocaeli'],
            ['province_id' => 53, 'locale' => 'en','name' => 'Konya'],
            ['province_id' => 54, 'locale' => 'en','name' => 'Kütahya'],
            ['province_id' => 55, 'locale' => 'en','name' => 'Malatya'],
            ['province_id' => 56, 'locale' => 'en','name' => 'Manisa'],
            ['province_id' => 57, 'locale' => 'en','name' => 'Mardin'],
            ['province_id' => 58, 'locale' => 'en','name' => 'Mersin'],
            ['province_id' => 59, 'locale' => 'en','name' => 'Muğla'],
            ['province_id' => 60, 'locale' => 'en','name' => 'Muş'],
            ['province_id' => 61, 'locale' => 'en','name' => 'Nevşehir'],
            ['province_id' => 62, 'locale' => 'en','name' => 'Niğde'],
            ['province_id' => 63, 'locale' => 'en','name' => 'Ordu'],
            ['province_id' => 64, 'locale' => 'en','name' => 'Osmaniye'],
            ['province_id' => 65, 'locale' => 'en','name' => 'Rize'],
            ['province_id' => 66, 'locale' => 'en','name' => 'Sakarya'],
            ['province_id' => 67, 'locale' => 'en','name' => 'Samsun'],
            ['province_id' => 68, 'locale' => 'en','name' => 'Siirt'],
            ['province_id' => 69, 'locale' => 'en','name' => 'Sinop'],
            ['province_id' => 70, 'locale' => 'en','name' => 'Sivas'],
            ['province_id' => 71, 'locale' => 'en','name' => 'Şanlıurfa'],
            ['province_id' => 72, 'locale' => 'en','name' => 'Şırnak'],
            ['province_id' => 73, 'locale' => 'en','name' => 'Tekirdağ'],
            ['province_id' => 74, 'locale' => 'en','name' => 'Tokat'],
            ['province_id' => 75, 'locale' => 'en','name' => 'Trabzon'],
            ['province_id' => 76, 'locale' => 'en','name' => 'Tunceli'],
            ['province_id' => 77, 'locale' => 'en','name' => 'Uşak'],
            ['province_id' => 78, 'locale' => 'en','name' => 'Van'],
            ['province_id' => 79, 'locale' => 'en','name' => 'Yalova'],
            ['province_id' => 80, 'locale' => 'en','name' => 'Yozgat'],
            ['province_id' => 81, 'locale' => 'en','name' => 'Zonguldak'],
        ];

        DB::table('province_translations')->insert($provinceTranslations);
        DB::table('province_translations')->insert($provinceTranslationsEn);
    }
}
