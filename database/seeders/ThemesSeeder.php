<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('themes')->insert([
            ['theme_name' => 'Lãng mạn'],
            ['theme_name' => 'Thanh lịch'],
            ['theme_name' => 'Tối giản'],
            ['theme_name' => 'Vui vẻ'],
            ['theme_name' => 'Tự nhiên'],
        ]);
    }
}

