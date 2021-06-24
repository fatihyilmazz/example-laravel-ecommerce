<?php

use Illuminate\Database\Seeder;

class UserAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //  $user = \App\User::find(\App\User::ADMIN_USER_ID);
      //  $country = \App\Country::find(\App\Country::ID_TURKEY);
      //  $province = \App\Province::whereTranslation('name', 'Denizli')->first();
      //  $district = \App\District::whereTranslation('name', 'Merkezefendi')->first();

        if (!empty($user) && !empty($country) && !empty($province) && !empty($district)) {
            DB::table('user_addresses')->delete();

            $userAddress = [
                [
                    'id' => 1,
                    'user_id' => $user->id,
                    'country_id' => $country->id,
                    'province_id' => $province->id,
                    'district_id' => $district->id,
                    'title' => 'Denizli Ev',
                    'first_name' => 'Tolga',
                    'last_name' => 'ÇIBIKÇI',
                    'company_name' => null,
                    'address' => 'Yeni Mh. Eski Sk. Merkezefendi/DENİZLİ',
                    'phone_number' => '5388311386',
                    'zip_code' => '20000',
                    'tax_office' => null,
                    'tax_number' => '12345678901',
                    'is_billing_address' => null,
                    'is_active' => true,
                    'created_at' => \Carbon\Carbon::now(),
                ],[
                    'id' => 2,
                    'user_id' => $user->id,
                    'country_id' => $country->id,
                    'province_id' => $province->id,
                    'district_id' => $district->id,
                    'title' => 'İstanul İş',
                    'first_name' => 'Tolga',
                    'last_name' => 'ÇIBIKÇI',
                    'company_name' => 'TLGSoft',
                    'address' => 'Yeni Mh. Eski Sk. Kağıthane/İSTANBUL',
                    'phone_number' => '5388311386',
                    'zip_code' => '34000',
                    'tax_office' => 'İstanbul',
                    'tax_number' => '12345678901',
                    'is_billing_address' => true,
                    'is_active' => true,
                    'created_at' => \Carbon\Carbon::now(),
                ],
            ];

       //     \App\UserAddress::insert($userAddress);
        }
    }
}
