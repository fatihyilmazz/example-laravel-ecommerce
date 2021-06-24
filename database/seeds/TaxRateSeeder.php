<?php

use Illuminate\Database\Seeder;

class TaxRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tax_rates')->delete();

        $taxRates = [
            [
                'id' => \App\TaxRate::ID_EIGHTEEN_PERCENT,
                'name' => '%18',
                'rate' => 18,
                'order' => null,
                'is_active' => true,
                'created_at' => \Carbon\Carbon::now(),
            ],[
                'id' => \App\TaxRate::ID_EIGHT_PERCENT,
                'name' => '%8',
                'rate' => 8,
                'order' => null,
                'is_active' => true,
                'created_at' => \Carbon\Carbon::now(),
            ],[
                'id' => \App\TaxRate::ID_ONE_PERCENT,
                'name' => '%1',
                'rate' => 1,
                'order' => null,
                'is_active' => true,
                'created_at' => \Carbon\Carbon::now(),
            ],
        ];

        \App\TaxRate::insert($taxRates);
    }
}
