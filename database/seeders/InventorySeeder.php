<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('inventory')->insert([
            ['product_id' => 1, 'quantity_in_stock' => 25],
            ['product_id' => 2, 'quantity_in_stock' => 20],
            ['product_id' => 3, 'quantity_in_stock' => 15],
            ['product_id' => 4, 'quantity_in_stock' => 18],
            ['product_id' => 5, 'quantity_in_stock' => 12],
            ['product_id' => 6, 'quantity_in_stock' => 30],
            ['product_id' => 7, 'quantity_in_stock' => 22],
            ['product_id' => 8, 'quantity_in_stock' => 10],
            ['product_id' => 9, 'quantity_in_stock' => 9],
            ['product_id' => 10, 'quantity_in_stock' => 14],
            ['product_id' => 11, 'quantity_in_stock' => 17],
            ['product_id' => 12, 'quantity_in_stock' => 13],
            ['product_id' => 13, 'quantity_in_stock' => 16],
            ['product_id' => 14, 'quantity_in_stock' => 19],
            ['product_id' => 15, 'quantity_in_stock' => 15],
            ['product_id' => 16, 'quantity_in_stock' => 8],
            ['product_id' => 17, 'quantity_in_stock' => 10],
            ['product_id' => 18, 'quantity_in_stock' => 12],
            ['product_id' => 19, 'quantity_in_stock' => 18],
            ['product_id' => 20, 'quantity_in_stock' => 16],
            ['product_id' => 21, 'quantity_in_stock' => 14],
            ['product_id' => 22, 'quantity_in_stock' => 20],
            ['product_id' => 23, 'quantity_in_stock' => 21],
            ['product_id' => 24, 'quantity_in_stock' => 11],
            ['product_id' => 25, 'quantity_in_stock' => 17],
            ['product_id' => 26, 'quantity_in_stock' => 9],
            ['product_id' => 27, 'quantity_in_stock' => 10],
            ['product_id' => 28, 'quantity_in_stock' => 13],
        ]);
    }
}

