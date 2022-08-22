<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shops = [
            [
             "shopname" => "shop-1", 
             "timestamp" => time(), 
             "password" =>Hash::make("password123")
            ],
            [
             "shopname" => "shop-2", 
             "timestamp" => time(), 
             "password" =>Hash::make("password123")
            ],
            [
              "shopname" => "shop-3", 
              "timestamp" => time(), 
              "password" =>Hash::make("password123")
            ],
        ];

        User::insert($shops);
    }
}
