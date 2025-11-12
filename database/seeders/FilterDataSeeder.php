<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilterDataSeeder extends Seeder
{
    public function run()
    {
        // Tắt foreign key checks tạm thời
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Xóa dữ liệu cũ
        DB::table('product_occasions')->truncate();
        DB::table('product_flower_types')->truncate();
        DB::table('product_styles')->truncate();
        DB::table('product_recipients')->truncate();
        DB::table('product_themes')->truncate();
        
        DB::table('occasions')->truncate();
        DB::table('flower_types')->truncate();
        DB::table('styles')->truncate();
        DB::table('recipients')->truncate();
        DB::table('themes')->truncate();

        // Bật lại foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Insert Themes
        $themes = [
            ['theme_name' => 'Lãng mạn'],
            ['theme_name' => 'Thanh lịch'],
            ['theme_name' => 'Tối giản'],
            ['theme_name' => 'Vui vẻ'],
            ['theme_name' => 'Tự nhiên'],
        ];
        DB::table('themes')->insert($themes);

        // Insert Recipients
        $recipients = [
            ['recipient_name' => 'Người yêu'],
            ['recipient_name' => 'Gia đình'],
            ['recipient_name' => 'Bạn bè'],
            ['recipient_name' => 'Đồng nghiệp'],
        ];
        DB::table('recipients')->insert($recipients);

        // Insert Styles
        $styles = [
            ['style_name' => 'Bó hoa'],
            ['style_name' => 'Hộp hoa'],
            ['style_name' => 'Chậu hoa'],
        ];
        DB::table('styles')->insert($styles);

        // Insert Flower Types
        $flowerTypes = [
            ['flower_type_name' => 'Hoa hồng'],
            ['flower_type_name' => 'Cẩm tú cầu'],
            ['flower_type_name' => 'Lan hồ điệp'],
            ['flower_type_name' => 'Thược dược'],
            ['flower_type_name' => 'Cát tường'],
            ['flower_type_name' => 'Hoa lily'],
            ['flower_type_name' => 'Astilbe'],
            ['flower_type_name' => 'Mẫu đơn'],
            ['flower_type_name' => 'Hoa dại'],
        ];
        DB::table('flower_types')->insert($flowerTypes);

        // Insert Occasions
        $occasions = [
            ['occasion_name' => 'Sinh nhật'],
            ['occasion_name' => 'Kỉ niệm'],
            ['occasion_name' => 'Đám cưới'],
            ['occasion_name' => 'Chúc mừng'],
            ['occasion_name' => 'Khác'],
        ];
        DB::table('occasions')->insert($occasions);

        // Product Themes
        $productThemes = [
            [1,1],[1,2], [2,2], [3,5],[3,4], [4,1],[4,2], [5,2],[5,3],
            [6,3], [7,1], [8,5], [9,2], [10,2], [11,1],[11,2], [12,1],
            [13,2],[13,5], [14,4], [15,2],[15,5], [16,2], [17,2], [18,2],
            [19,2], [20,2], [21,2], [22,1], [23,1], [24,5], [25,4],
            [26,2], [27,2], [28,1]
        ];
        foreach ($productThemes as $pt) {
            DB::table('product_themes')->insert([
                'product_id' => $pt[0],
                'theme_id' => $pt[1]
            ]);
        }

        // Product Recipients
        $productRecipients = [
            [1,1], [2,1], [3,3], [4,1], [5,4], [6,1], [7,2], [8,2],
            [9,1], [10,1], [11,2], [12,1], [13,3], [14,3], [15,4],
            [16,2], [17,4], [18,2], [19,1], [20,3], [21,3], [22,1],
            [23,1], [24,2], [25,3], [26,2], [27,1], [28,3]
        ];
        foreach ($productRecipients as $pr) {
            DB::table('product_recipients')->insert([
                'product_id' => $pr[0],
                'recipient_id' => $pr[1]
            ]);
        }

        // Product Styles
        $productStyles = [
            [1,2], [2,2], [3,3], [4,3], [5,2], [6,2], [7,2], [8,3],
            [9,3], [10,2], [11,2], [12,2], [13,1], [14,1], [15,1],
            [16,3], [17,3], [18,1], [19,3], [20,3], [21,2], [22,2],
            [23,3], [24,3], [25,1], [26,3], [27,3], [28,3]
        ];
        foreach ($productStyles as $ps) {
            DB::table('product_styles')->insert([
                'product_id' => $ps[0],
                'style_id' => $ps[1]
            ]);
        }

        // Product Flower Types
        $productFlowerTypes = [
            [1,1], [1,7], [2,1], [3,9], [3,6], [4,1], [5,1], [5,3],
            [6,1], [7,2], [8,2], [8,4], [8,9], [9,2], [9,8], [10,2],
            [10,3], [11,2], [11,1], [11,5], [12,2], [12,1], [12,3],
            [13,1], [13,5], [14,1], [14,5], [15,1], [15,5], [16,3],
            [17,1], [18,3], [19,2], [19,5], [19,1], [19,7], [20,2],
            [20,1], [21,2], [21,1], [21,5], [22,1], [22,7], [23,1],
            [23,7], [24,4], [25,1], [25,9], [26,3], [27,3], [28,4], [28,1]
        ];
        foreach ($productFlowerTypes as $pft) {
            DB::table('product_flower_types')->insert([
                'product_id' => $pft[0],
                'flower_type_id' => $pft[1]
            ]);
        }

        // Product Occasions
        $productOccasions = [
            [1,2], [2,2], [3,4], [4,2], [5,3], [6,4], [7,1], [8,5],
            [9,2], [10,2], [11,1], [12,2], [13,4], [14,1], [15,4],
            [16,5], [17,2], [18,1], [19,1], [20,4], [21,4], [22,2],
            [23,4], [24,5], [25,1], [26,5], [27,2], [28,4]
        ];
        foreach ($productOccasions as $po) {
            DB::table('product_occasions')->insert([
                'product_id' => $po[0],
                'occasion_id' => $po[1]
            ]);
        }

        $this->command->info('✅ Filter data seeded successfully!');
        $this->command->info('📊 Seeded ' . count($productThemes) . ' product-theme relationships');
        $this->command->info('📊 Seeded ' . count($productRecipients) . ' product-recipient relationships');
        $this->command->info('📊 Seeded ' . count($productStyles) . ' product-style relationships');
        $this->command->info('📊 Seeded ' . count($productFlowerTypes) . ' product-flowertype relationships');
        $this->command->info('📊 Seeded ' . count($productOccasions) . ' product-occasion relationships');
    }
}