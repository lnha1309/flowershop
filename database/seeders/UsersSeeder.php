<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['username' => 'admin01', 'email' => 'admin01@example.com', 'password' => 'admin123', 'full_name' => 'Nguyễn Văn Quản Trị', 'gender' => 'Nam', 'phone' => '0901234567', 'role_id' => 1],
            ['username' => 'khach01', 'email' => 'khach01@example.com', 'password' => 'khach01@example.com', 'full_name' => 'Trần Văn Quang', 'gender' => 'Nam', 'phone' => '0905678901', 'role_id' => 2],
            ['username' => 'khach02', 'email' => 'khach02@example.com', 'password' => 'khach02@example.com', 'full_name' => 'Võ Thị Hồng', 'gender' => 'Nữ', 'phone' => '0905641901', 'role_id' => 2],
            ['username' => 'khach03', 'email' => 'khach03@example.com', 'password' => 'khach03@example.com', 'full_name' => 'Đặng Thanh Tuấn', 'gender' => 'Nam', 'phone' => '090124525', 'role_id' => 2],
            ['username' => 'khach04', 'email' => 'khach04@example.com', 'password' => 'khach04@example.com', 'full_name' => 'Nguyễn Hoàng Nam', 'gender' => 'Nam', 'phone' => '0905612301', 'role_id' => 2],
            ['username' => 'khach05', 'email' => 'khach05@example.com', 'password' => 'khach05@example.com', 'full_name' => 'Lê Thị Quế Trân', 'gender' => 'Nữ', 'phone' => '0905741924', 'role_id' => 2],
        ];

        foreach ($rows as $r) {
            DB::table('users')->insert([
                'username' => $r['username'],
                'email' => $r['email'],
                'password' => Hash::make($r['password']),
                'full_name' => $r['full_name'] ?? null,
                'gender' => $r['gender'] ?? null,
                'phone' => $r['phone'] ?? null,
                'role_id' => $r['role_id'] ?? null,
                'created_at' => now(),
            ]);
        }
    }
}
