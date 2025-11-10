<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipientsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('recipients')->insert([
            ['recipient_name' => 'Người yêu'],
            ['recipient_name' => 'Gia đình'],
            ['recipient_name' => 'Bạn bè'],
            ['recipient_name' => 'Đồng nghiệp'],
        ]);
    }
}

