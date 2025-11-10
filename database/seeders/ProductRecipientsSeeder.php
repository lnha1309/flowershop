<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductRecipientsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('product_recipients')->insert([
            ['product_id' => 1,'recipient_id' => 1],
            ['product_id' => 2,'recipient_id' => 1],
            ['product_id' => 3,'recipient_id' => 3],
            ['product_id' => 4,'recipient_id' => 1],
            ['product_id' => 5,'recipient_id' => 4],
            ['product_id' => 6,'recipient_id' => 1],
            ['product_id' => 7,'recipient_id' => 2],
            ['product_id' => 8,'recipient_id' => 2],
            ['product_id' => 9,'recipient_id' => 1],
            ['product_id' => 10,'recipient_id' => 1],
            ['product_id' => 11,'recipient_id' => 2],
            ['product_id' => 12,'recipient_id' => 1],
            ['product_id' => 13,'recipient_id' => 3],
            ['product_id' => 14,'recipient_id' => 3],
            ['product_id' => 15,'recipient_id' => 4],
            ['product_id' => 16,'recipient_id' => 2],
            ['product_id' => 17,'recipient_id' => 4],
            ['product_id' => 18,'recipient_id' => 2],
            ['product_id' => 19,'recipient_id' => 1],
            ['product_id' => 20,'recipient_id' => 3],
            ['product_id' => 21,'recipient_id' => 3],
            ['product_id' => 22,'recipient_id' => 1],
            ['product_id' => 23,'recipient_id' => 1],
            ['product_id' => 24,'recipient_id' => 2],
            ['product_id' => 25,'recipient_id' => 3],
            ['product_id' => 26,'recipient_id' => 2],
            ['product_id' => 27,'recipient_id' => 1],
            ['product_id' => 28,'recipient_id' => 3],
        ]);
    }
}

