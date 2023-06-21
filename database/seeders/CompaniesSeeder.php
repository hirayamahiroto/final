<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("companies")->insert([
            [
                "name" => "田中太郎",
                "email" => "taro@gmail.com",
                "password" => Hash::make("password"),
            ],
        ]);
    }
}