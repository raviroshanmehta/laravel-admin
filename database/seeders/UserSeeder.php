<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'superadmin@yopmail.com',
            'role' => 'superadmin',
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@yopmail.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);
    }
}
