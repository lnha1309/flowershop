<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('orders')->insert([
            ['user_id' => 1, 'order_date' => '2025-11-02 09:40:00', 'status' => 'Delivered', 'total_amount' => 700000.00, 'discount' => 70000.00, 'payment_method_id' => 3, 'shipping_address_id' => 1],
            ['user_id' => 2, 'order_date' => '2025-12-10 15:20:00', 'status' => 'Processing', 'total_amount' => 1498000.00, 'discount' => 224700.00, 'payment_method_id' => 1, 'shipping_address_id' => 2],
            ['user_id' => 3, 'order_date' => '2025-12-23 11:10:00', 'status' => 'Pending', 'total_amount' => 570000.00, 'discount' => 28500.00, 'payment_method_id' => 2, 'shipping_address_id' => 3],
            ['user_id' => 4, 'order_date' => '2026-01-03 17:45:00', 'status' => 'Delivered', 'total_amount' => 920000.00, 'discount' => 184000.00, 'payment_method_id' => 1, 'shipping_address_id' => 4],
            ['user_id' => 5, 'order_date' => '2026-03-05 08:30:00', 'status' => 'Pending', 'total_amount' => 1158000.00, 'discount' => 138960.00, 'payment_method_id' => 3, 'shipping_address_id' => 5],
        ]);
    }
}

