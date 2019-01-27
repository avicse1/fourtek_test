<?php

use Illuminate\Database\Seeder;

class AdminLoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = 
        [
            [
                'first_name' => 'Admin',
                'last_name' => 'Fourtek',
                'email'=> 'admin@avinashjaiswal.me',
                'password' => bcrypt('admin'),
                'role' => 'admin',
                'is_email_verified'=> 'yes',
            ],
        ];        

        \App\User::insert($admin);
    }
}
