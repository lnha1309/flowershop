<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromotionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('promotions')->insert([
            [
                'title' => 'Khuyến mãi Tháng 11',
                'description' => 'Giảm 10% cho tất cả đơn hàng trong chương trình “Tháng tri ân khách hàng”.',
                'discount_percent' => 10.00,
                'start_date' => '2025-11-01',
                'end_date' => '2025-11-15',
            ],
            [
                'title' => 'Tri ân cuối năm',
                'description' => 'Ưu đãi 15% khi mua hoa trong suốt tháng 12, gửi ngàn yêu thương cuối năm.',
                'discount_percent' => 15.00,
                'start_date' => '2025-12-01',
                'end_date' => '2025-12-31',
            ],
            [
                'title' => 'Giáng Sinh Rực Rỡ',
                'description' => 'Giảm 5% cho mọi đơn hàng trong tuần lễ Giáng Sinh.',
                'discount_percent' => 5.00,
                'start_date' => '2025-12-20',
                'end_date' => '2025-12-26',
            ],
            [
                'title' => 'Chào năm mới 2026',
                'description' => 'Đón năm mới với niềm vui tươi – Giảm 20% cho toàn bộ đơn hàng đầu năm.',
                'discount_percent' => 20.00,
                'start_date' => '2026-01-01',
                'end_date' => '2026-01-05',
            ],
            [
                'title' => 'Tháng của Yêu Thương – 8/3',
                'description' => 'Giảm 12% nhân dịp Quốc tế Phụ nữ, lan tỏa yêu thương tới một nửa thế giới.',
                'discount_percent' => 12.00,
                'start_date' => '2026-03-01',
                'end_date' => '2026-03-08',
            ],
        ]);
    }
}

