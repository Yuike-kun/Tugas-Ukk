<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'email' => 'yui@gmail.com',
            'username' => 'yui',
            'password' => '$2y$12$KCRxjiciXwhbEKWaKAlsg.5JsgPohs2c1fZWvx77LBtLoyVUiXm1a',
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
