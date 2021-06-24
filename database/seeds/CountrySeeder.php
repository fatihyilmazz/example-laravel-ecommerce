<?php

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->delete();

        DB::table('countries')->insert([
            'id' => \App\Country::ID_TURKEY,
          //  'iso_code' => 'TR',
            'order' => null,
            'is_active' => true,
            'created_at' => \Carbon\Carbon::now(),
        ]);


        DB::table('country_translations')->insert([
           [
               'country_id' => \App\Country::ID_TURKEY,
               'locale' => 'tr',
               'name' => 'Türkiye',
           ], [
                'country_id' => \App\Country::ID_TURKEY,
                'locale' => 'en',
                'name' => 'Turkey',
            ]
        ]);
    }
}
