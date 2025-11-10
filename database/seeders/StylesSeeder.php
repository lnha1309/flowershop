<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StylesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('styles')->insert([
            ['style_name' => 'Bó hoa'],
            ['style_name' => 'Hộp hoa'],
            ['style_name' => 'Chậu hoa'],
        ]);
    }
}

