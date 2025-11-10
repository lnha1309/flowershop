<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductFlowerTypesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('product_flower_types')->insert([
            ['product_id' => 1, 'flower_type_id' => 1], ['product_id' => 1, 'flower_type_id' => 7],
            ['product_id' => 2, 'flower_type_id' => 1],
            ['product_id' => 3, 'flower_type_id' => 9], ['product_id' => 3, 'flower_type_id' => 6],
            ['product_id' => 4, 'flower_type_id' => 1],
            ['product_id' => 5, 'flower_type_id' => 1], ['product_id' => 5, 'flower_type_id' => 3],
            ['product_id' => 6, 'flower_type_id' => 1],
            ['product_id' => 7, 'flower_type_id' => 2],
            ['product_id' => 8, 'flower_type_id' => 2], ['product_id' => 8, 'flower_type_id' => 4], ['product_id' => 8, 'flower_type_id' => 9],
            ['product_id' => 9, 'flower_type_id' => 2], ['product_id' => 9, 'flower_type_id' => 8],
            ['product_id' => 10, 'flower_type_id' => 2], ['product_id' => 10, 'flower_type_id' => 3],
            ['product_id' => 11, 'flower_type_id' => 2], ['product_id' => 11, 'flower_type_id' => 1], ['product_id' => 11, 'flower_type_id' => 5],
            ['product_id' => 12, 'flower_type_id' => 2], ['product_id' => 12, 'flower_type_id' => 1], ['product_id' => 12, 'flower_type_id' => 3],
            ['product_id' => 13, 'flower_type_id' => 1], ['product_id' => 13, 'flower_type_id' => 5],
            ['product_id' => 14, 'flower_type_id' => 1], ['product_id' => 14, 'flower_type_id' => 5],
            ['product_id' => 15, 'flower_type_id' => 1], ['product_id' => 15, 'flower_type_id' => 5],
            ['product_id' => 16, 'flower_type_id' => 3],
            ['product_id' => 17, 'flower_type_id' => 1],
            ['product_id' => 18, 'flower_type_id' => 3],
            ['product_id' => 19, 'flower_type_id' => 2], ['product_id' => 19, 'flower_type_id' => 5], ['product_id' => 19, 'flower_type_id' => 1], ['product_id' => 19, 'flower_type_id' => 7],
            ['product_id' => 20, 'flower_type_id' => 2], ['product_id' => 20, 'flower_type_id' => 1],
            ['product_id' => 21, 'flower_type_id' => 2], ['product_id' => 21, 'flower_type_id' => 1], ['product_id' => 21, 'flower_type_id' => 5],
            ['product_id' => 22, 'flower_type_id' => 1], ['product_id' => 22, 'flower_type_id' => 7],
            ['product_id' => 23, 'flower_type_id' => 1], ['product_id' => 23, 'flower_type_id' => 7],
            ['product_id' => 24, 'flower_type_id' => 4],
            ['product_id' => 25, 'flower_type_id' => 1], ['product_id' => 25, 'flower_type_id' => 9],
            ['product_id' => 26, 'flower_type_id' => 3],
            ['product_id' => 27, 'flower_type_id' => 3],
            ['product_id' => 28, 'flower_type_id' => 4], ['product_id' => 28, 'flower_type_id' => 1],
        ]);
    }
}

