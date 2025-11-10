<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductReviewsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('product_reviews')->insert([
            ['product_id' => 1, 'user_id' => 1, 'rating' => 5, 'comment' => 'Hoa tươi, gói đẹp, giao đúng giờ. Rất hài lòng!'],
            ['product_id' => 6, 'user_id' => 1, 'rating' => 4, 'comment' => 'Bó hoa nhìn sang trọng, nhưng hơi ít hoa hơn mong đợi.'],
            ['product_id' => 12, 'user_id' => 2, 'rating' => 5, 'comment' => 'Hộp hoa rất tinh tế, màu sắc dịu, phù hợp làm quà.'],
            ['product_id' => 7, 'user_id' => 3, 'rating' => 4, 'comment' => 'Hoa tươi và xinh, nhưng gói hơi đơn giản.'],
            ['product_id' => 13, 'user_id' => 4, 'rating' => 5, 'comment' => 'Bó hoa rất đẹp, mùi dịu nhẹ, người nhận rất thích.'],
            ['product_id' => 25, 'user_id' => 5, 'rating' => 5, 'comment' => 'Màu hoa sáng, bố cục cân đối, đáng tiền.'],
            ['product_id' => 19, 'user_id' => 5, 'rating' => 4, 'comment' => 'Giao hàng nhanh, hoa đẹp nhưng thiệp tặng hơi nhăn.'],
            ['product_id' => 28, 'user_id' => 4, 'rating' => 5, 'comment' => 'Màu sắc rực rỡ, thiết kế nghệ thuật, chắc chắn sẽ mua lại.'],
            ['product_id' => 14, 'user_id' => 2, 'rating' => 5, 'comment' => 'Tông vàng cam rực rỡ, nhìn lên hình còn đẹp hơn thật.'],
            ['product_id' => 3, 'user_id' => 3, 'rating' => 4, 'comment' => 'Hoa tươi, phối màu độc đáo, nhưng giá hơi cao.'],
        ]);
    }
}

