<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartItemsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cart_items')->insert([
            ['user_id' => 1, 'product_id' => 6, 'quantity' => 1],
            ['user_id' => 1, 'product_id' => 1, 'quantity' => 2],
            ['user_id' => 2, 'product_id' => 12, 'quantity' => 1],
            ['user_id' => 2, 'product_id' => 14, 'quantity' => 1],
            ['user_id' => 3, 'product_id' => 7, 'quantity' => 1],
            ['user_id' => 3, 'product_id' => 15, 'quantity' => 1],
            ['user_id' => 4, 'product_id' => 13, 'quantity' => 1],
            ['user_id' => 4, 'product_id' => 28, 'quantity' => 1],
            ['user_id' => 5, 'product_id' => 25, 'quantity' => 1],
            ['user_id' => 5, 'product_id' => 19, 'quantity' => 2],
        ]);
    }
}

