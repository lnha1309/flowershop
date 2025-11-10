<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('payment_methods')->insert([
            ['method_name' => 'Chuyển khoản qua mã QR Napas'],
            ['method_name' => 'Thanh toán qua ví điện tử'],
            ['method_name' => 'Thanh toán khi nhận hàng (COD)'],
        ]);
    }
}

