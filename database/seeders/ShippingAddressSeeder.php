<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingAddressSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('shipping_address')->insert([
            ['user_id' => 1, 'address_detail' => '123 Nguyễn Trãi, Phường 14', 'district' => 'Quận 5', 'province' => 'TP Hồ Chí Minh', 'phone' => '0905123456'],
            ['user_id' => 2, 'address_detail' => '45 Lý Tự Trọng, Phường Bến Nghé', 'district' => 'Quận 1', 'province' => 'TP Hồ Chí Minh', 'phone' => '0918234567'],
            ['user_id' => 3, 'address_detail' => '89 Lê Duẩn', 'district' => 'Quận Hải Châu', 'province' => 'Đà Nẵng', 'phone' => '0934567890'],
            ['user_id' => 4, 'address_detail' => '102 Lạc Long Quân', 'district' => 'Quận Tây Hồ', 'province' => 'Hà Nội', 'phone' => '0987654321'],
            ['user_id' => 5, 'address_detail' => '27 Nguyễn Hữu Cảnh', 'district' => 'Quận Bình Thạnh', 'province' => 'TP Hồ Chí Minh', 'phone' => '0909988776'],
        ]);
    }
}

