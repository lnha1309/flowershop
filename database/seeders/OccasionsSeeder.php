<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OccasionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('occasions')->insert([
            ['occasion_name' => 'Sinh nhật'],
            ['occasion_name' => 'Kỉ niệm'],
            ['occasion_name' => 'Đám cưới'],
            ['occasion_name' => 'Chúc mừng'],
            ['occasion_name' => 'Khác'],
        ]);
    }
}

