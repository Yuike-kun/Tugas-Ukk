<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::insert('insert into kelas(nama) values (?)', ["XII RPL 2"]);
        DB::insert('insert into kelas(nama) values (?)', ["XII RPL 1"]);
        DB::insert('insert into kelas(nama) values (?)', ["XII TKJ"]);
        DB::insert('insert into kelas(nama) values (?)', ["XII MMK"]);
        DB::insert('insert into kelas(nama) values (?)', ["XI RPL 2"]);
        DB::insert('insert into kelas(nama) values (?)', ["XI RPL 1"]);
        DB::insert('insert into kelas(nama) values (?)', ["XI MMK"]);
        DB::insert('insert into kelas(nama) values (?)', ["XI TKJ"]);
        DB::insert('insert into kelas(nama) values (?)', ["X DKV"]);
        DB::insert('insert into kelas(nama) values (?)', ["X PPLG"]);
        DB::insert('insert into kelas(nama) values (?)', ["X TJKT 2"]);
        DB::insert('insert into kelas(nama) values (?)', ["X TJKT 1"]);
    }
}
