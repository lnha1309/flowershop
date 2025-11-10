<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductThemesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('product_themes')->insert([
            ['product_id' => 1,'theme_id' => 1],['product_id' => 1,'theme_id' => 2],
            ['product_id' => 2,'theme_id' => 2],
            ['product_id' => 3,'theme_id' => 5],['product_id' => 3,'theme_id' => 4],
            ['product_id' => 4,'theme_id' => 1],['product_id' => 4,'theme_id' => 2],
            ['product_id' => 5,'theme_id' => 2],['product_id' => 5,'theme_id' => 3],
            ['product_id' => 6,'theme_id' => 3],
            ['product_id' => 7,'theme_id' => 1],
            ['product_id' => 8,'theme_id' => 5],
            ['product_id' => 9,'theme_id' => 2],
            ['product_id' => 10,'theme_id' => 2],
            ['product_id' => 11,'theme_id' => 1],['product_id' => 11,'theme_id' => 2],
            ['product_id' => 12,'theme_id' => 1],
            ['product_id' => 13,'theme_id' => 2],['product_id' => 13,'theme_id' => 5],
            ['product_id' => 14,'theme_id' => 4],
            ['product_id' => 15,'theme_id' => 2],['product_id' => 15,'theme_id' => 5],
            ['product_id' => 16,'theme_id' => 2],
            ['product_id' => 17,'theme_id' => 2],
            ['product_id' => 18,'theme_id' => 2],
            ['product_id' => 19,'theme_id' => 2],
            ['product_id' => 20,'theme_id' => 2],
            ['product_id' => 21,'theme_id' => 2],
            ['product_id' => 22,'theme_id' => 1],
            ['product_id' => 23,'theme_id' => 1],
            ['product_id' => 24,'theme_id' => 5],
            ['product_id' => 25,'theme_id' => 4],
            ['product_id' => 26,'theme_id' => 2],
            ['product_id' => 27,'theme_id' => 2],
            ['product_id' => 28,'theme_id' => 1],
        ]);
    }
}

