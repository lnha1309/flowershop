<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlowerTypesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('flower_types')->insert([
            ['flower_type_name' => 'Hoa hồng'],
            ['flower_type_name' => 'Cẩm tú cầu'],
            ['flower_type_name' => 'Lan hồ điệp'],
            ['flower_type_name' => 'Thược dược'],
            ['flower_type_name' => 'Cát tường'],
            ['flower_type_name' => 'Hoa lily'],
            ['flower_type_name' => 'Astilbe'],
            ['flower_type_name' => 'Mẫu đơn'],
            ['flower_type_name' => 'Hoa dại'],
        ]);
    }
}

