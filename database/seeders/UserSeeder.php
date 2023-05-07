<?php

namespace Database\Seeders;

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

        $user = \App\Models\User::create([
            'name' => 'super adimn',
            'email' => 'user@user.user',
            'password' => bcrypt('123456789'),
            'email_verified_at'=> '2021-08-07 02:44:01',
        ]);
        $user->attachRole('super-admin');
    }
}
