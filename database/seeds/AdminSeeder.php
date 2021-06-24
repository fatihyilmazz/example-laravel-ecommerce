<?php

use App\Admin;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();

        $admins = [
            [
                'id' => Admin::ID_SYSTEM_USER,
                'first_name' => 'Sistem',
                'last_name' => 'Sistem',
                'email' => 'system@system.com',
                'phone_number' => null,
                'password' => Hash::make('system@system.com'),
                'is_active' => false,
                'is_sms_allowed' => false,
                'is_mail_allowed' => false,
                'last_login_at' => null,
                'created_at' => Carbon::now(),
                'deleted_at' => Carbon::now(),
            ],[
                'id' => Admin::ID_SUPER_ADMIN_USER,
                'first_name' => 'Super Admin',
                'last_name' => 'Super Admin',
                'email' => 'superadmin@superadmin.com',
                'phone_number' => null,
                'password' => Hash::make('123456'),
                'is_active' => true,
                'is_sms_allowed' => true,
                'is_mail_allowed' => true,
                'last_login_at' => null,
                'created_at' => Carbon::now(),
                'deleted_at' => null,
            ],[
                'id' => Admin::ID_ADMIN_USER,
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@admin.com',
                'phone_number' => null,
                'password' => Hash::make('123456'),
                'is_active' => true,
                'is_sms_allowed' => true,
                'is_mail_allowed' => true,
                'last_login_at' => null,
                'created_at' => Carbon::now(),
                'deleted_at' => null,
            ],
        ];

        Admin::insert($admins);
    }
}
