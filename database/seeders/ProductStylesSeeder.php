<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductStylesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('product_styles')->insert([
            ['product_id' => 1,'style_id' => 2],
            ['product_id' => 2,'style_id' => 2],
            ['product_id' => 3,'style_id' => 3],
            ['product_id' => 4,'style_id' => 3],
            ['product_id' => 5,'style_id' => 2],
            ['product_id' => 6,'style_id' => 2],
            ['product_id' => 7,'style_id' => 2],
            ['product_id' => 8,'style_id' => 3],
            ['product_id' => 9,'style_id' => 3],
            ['product_id' => 10,'style_id' => 2],
            ['product_id' => 11,'style_id' => 2],
            ['product_id' => 12,'style_id' => 2],
            ['product_id' => 13,'style_id' => 1],
            ['product_id' => 14,'style_id' => 1],
            ['product_id' => 15,'style_id' => 1],
            ['product_id' => 16,'style_id' => 3],
            ['product_id' => 17,'style_id' => 3],
            ['product_id' => 18,'style_id' => 1],
            ['product_id' => 19,'style_id' => 3],
            ['product_id' => 20,'style_id' => 3],
            ['product_id' => 21,'style_id' => 2],
            ['product_id' => 22,'style_id' => 2],
            ['product_id' => 23,'style_id' => 3],
            ['product_id' => 24,'style_id' => 3],
            ['product_id' => 25,'style_id' => 1],
            ['product_id' => 26,'style_id' => 3],
            ['product_id' => 27,'style_id' => 3],
            ['product_id' => 28,'style_id' => 3],
        ]);
    }
}

