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
             "username"  => "shop-1.myshopify.com", 
             "shopname"  => "shop-1.myshopify.com", 
             "timestamp" => time(), 
             "password"  => Hash::make("password123")
            ],
            [
             "username"  => "shop-2.myshopify.com",  
             "shopname"  => "shop-2.myshopify.com", 
             "timestamp" => time(), 
             "password"  => Hash::make("password123")
            ],
            [
              "username"  => "shop-3.myshopify.com",
              "shopname"  => "shop-3.myshopify.com", 
              "timestamp" => time(), 
              "password"  => Hash::make("password123")
            ],
        ];

        User::insert($shops);
    }
}
