<?php

use Illuminate\Database\Seeder;
use App\Currency;
use Carbon\Carbon;


class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->delete();

        DB::table('currencies')->insert([
            'id' => Currency::ID_TL,
            'name' => 'Türk Lirası',
            'code' => 'TL',
            'symbol' => '₺',
            'use_constant' => true,
            'constant_price' => 1,
            'order' => null,
            'is_active' => true,
            'created_at' => Carbon::now(),
        ]);

        DB::table('currencies')->insert([
            'id' => Currency::ID_USD,
            'name' => 'Dolar',
            'code' => 'USD',
            'symbol' => '$',
            'use_constant' => false,
            'constant_price' => null,
            'order' => null,
            'is_active' => true,
            'created_at' => Carbon::now(),
        ]);

        DB::table('currencies')->insert([
            'id' => Currency::ID_EUR,
            'name' => 'Euro',
            'code' => 'EUR',
            'symbol' => '€',
            'use_constant' => false,
            'constant_price' => null,
            'order' => null,
            'is_active' => true,
            'created_at' => Carbon::now(),
        ]);
    }
}
