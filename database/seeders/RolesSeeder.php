<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['role_name' => 'Admin'],
            ['role_name' => 'Khách hàng'],
        ]);
    }
}

