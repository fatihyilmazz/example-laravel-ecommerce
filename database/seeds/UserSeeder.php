<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $users = [
            [
                'first_name' => 'Demo',
                'last_name' => 'Demo',
                'email' => 'demo@demo.com',
                'phone_number' => null,
                'password' => Hash::make('123456'),
                'is_active' => true,
                'is_sms_allowed' => true,
                'is_mail_allowed' => true,
                'email_verified_at' => null,
                'last_login_at' => null,
                'created_at' => Carbon::now(),
                'deleted_at' => Carbon::now(),
            ],
        ];

        User::insert($users);
    }
}
