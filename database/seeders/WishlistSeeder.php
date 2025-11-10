<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WishlistSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('wishlist')->insert([
            ['user_id' => 1, 'product_id' => 12],
            ['user_id' => 1, 'product_id' => 20],
            ['user_id' => 2, 'product_id' => 5],
            ['user_id' => 2, 'product_id' => 1],
            ['user_id' => 3, 'product_id' => 13],
            ['user_id' => 3, 'product_id' => 7],
            ['user_id' => 4, 'product_id' => 15],
            ['user_id' => 4, 'product_id' => 28],
            ['user_id' => 5, 'product_id' => 19],
            ['user_id' => 5, 'product_id' => 25],
        ]);
    }
}

