<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('order_items')->insert([
            // Order 1
            ['order_id' => 1, 'product_id' => 1, 'quantity' => 2, 'unit_price' => 350000.00],
            // Order 2
            ['order_id' => 2, 'product_id' => 5, 'quantity' => 1, 'unit_price' => 590000.00],
            ['order_id' => 2, 'product_id' => 12, 'quantity' => 1, 'unit_price' => 648000.00],
            ['order_id' => 2, 'product_id' => 25, 'quantity' => 1, 'unit_price' => 399000.00],
            // Order 3
            ['order_id' => 3, 'product_id' => 7, 'quantity' => 1, 'unit_price' => 570000.00],
            // Order 4
            ['order_id' => 4, 'product_id' => 13, 'quantity' => 1, 'unit_price' => 878000.00],
            // Order 5
            ['order_id' => 5, 'product_id' => 11, 'quantity' => 1, 'unit_price' => 558000.00],
            ['order_id' => 5, 'product_id' => 19, 'quantity' => 1, 'unit_price' => 357000.00],
        ]);
    }
}

