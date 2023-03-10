<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return voidno
     * 
     */
    public function run()
    {
        DB::table('user')->insert([
            'role_id' => '1',
            'name' => 'Admin',
            'email' => 'admin@laundry.com',
            'password' => bcrypt('admin'),
            'remember_token' => Str::random(20)
        ]);
    }
}
