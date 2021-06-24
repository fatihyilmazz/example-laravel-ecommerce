<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SystemTypeSeeder::class,
            PackageModuleSeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
            CountrySeeder::class,
            CurrencySeeder::class,
            LocaleSeeder::class,
            MenuGroupSeeder::class,
            MenuTypeSeeder::class,
            ProductTypeSeeder::class,
            ProvinceSeeder::class,
            DistrictSeeder::class,
            SettingSeeder::class,
            SliderTypeSeeder::class,
            //StockUnitSeeder::class,
            TaxRateSeeder::class,
            RolesAndPermissionsSeeder::class,
        ]);

        if (config('app.env') == 'local') {
            $this->call([
                BrandSeeder::class,
                CategorySeeder::class,
                MenuSeeder::class,
                PageSeeder::class,
                ProductSeeder::class,
                SupplierSeeder::class,
                UserAddressSeeder::class,
            ]);
        }
    }
}
