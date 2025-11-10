<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductOccasionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('product_occasions')->insert([
            ['product_id' => 1,'occasion_id' => 2],
            ['product_id' => 2,'occasion_id' => 2],
            ['product_id' => 3,'occasion_id' => 4],
            ['product_id' => 4,'occasion_id' => 2],
            ['product_id' => 5,'occasion_id' => 3],
            ['product_id' => 6,'occasion_id' => 4],
            ['product_id' => 7,'occasion_id' => 1],
            ['product_id' => 8,'occasion_id' => 5],
            ['product_id' => 9,'occasion_id' => 2],
            ['product_id' => 10,'occasion_id' => 2],
            ['product_id' => 11,'occasion_id' => 1],
            ['product_id' => 12,'occasion_id' => 2],
            ['product_id' => 13,'occasion_id' => 4],
            ['product_id' => 14,'occasion_id' => 1],
            ['product_id' => 15,'occasion_id' => 4],
            ['product_id' => 16,'occasion_id' => 5],
            ['product_id' => 17,'occasion_id' => 2],
            ['product_id' => 18,'occasion_id' => 1],
            ['product_id' => 19,'occasion_id' => 1],
            ['product_id' => 20,'occasion_id' => 4],
            ['product_id' => 21,'occasion_id' => 4],
            ['product_id' => 22,'occasion_id' => 2],
            ['product_id' => 23,'occasion_id' => 4],
            ['product_id' => 24,'occasion_id' => 5],
            ['product_id' => 25,'occasion_id' => 1],
            ['product_id' => 26,'occasion_id' => 5],
            ['product_id' => 27,'occasion_id' => 2],
            ['product_id' => 28,'occasion_id' => 4],
        ]);
    }
}

