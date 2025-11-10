<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderTrackingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('order_tracking')->insert([
            ['order_id' => 1, 'status' => 'Delivered', 'description' => 'Đơn hàng đã được giao thành công cho khách.'],
            ['order_id' => 2, 'status' => 'Processing', 'description' => 'Đơn hàng đang được chuẩn bị và gói quà.'],
            ['order_id' => 3, 'status' => 'Pending', 'description' => 'Đơn hàng đã được đặt, chờ xác nhận thanh toán.'],
            ['order_id' => 4, 'status' => 'Delivered', 'description' => 'Đơn hàng giao thành công vào sáng hôm nay.'],
            ['order_id' => 5, 'status' => 'Pending', 'description' => 'Đơn đặt được ghi nhận, chờ xác nhận từ nhân viên.'],
            ['order_id' => 1, 'status' => 'Shipped', 'description' => 'Đơn hàng đã xuất kho và đang giao đến địa chỉ.'],
            ['order_id' => 2, 'status' => 'Order Placed', 'description' => 'Khách đã hoàn tất đặt hàng qua website.'],
            ['order_id' => 4, 'status' => 'Shipped', 'description' => 'Đơn hàng đang được giao bởi đối tác vận chuyển.'],
            ['order_id' => 3, 'status' => 'Processing', 'description' => 'Sản phẩm đang được đóng gói.'],
            ['order_id' => 5, 'status' => 'Cancelled', 'description' => 'Khách yêu cầu hủy đơn hàng này.'],
        ]);
    }
}

