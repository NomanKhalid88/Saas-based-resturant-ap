<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Merchant;
use App\Models\User;
use App\Models\Category;
use App\Models\ProductCategory;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | MERCHANT 1
        |--------------------------------------------------------------------------
        */

        $pizza = Merchant::create([
            'uuid' => generateUuidKey(),
            'name' => 'Pizza Palace',
            'email' => 'pizza@demo.com',
            'phone' => '03001234567',
            'address' => 'Lahore, Pakistan',
        ]);

        /*
        |--------------------------------------------------------------------------
        | MERCHANT 2
        |--------------------------------------------------------------------------
        */

        $burger = Merchant::create([
            'uuid' => generateUuidKey(),
            'name' => 'Burger House',
            'email' => 'burger@demo.com',
            'phone' => '03111222333',
            'address' => 'Karachi, Pakistan',
        ]);

        /*
        |--------------------------------------------------------------------------
        | USERS (FOR LOGIN TESTING)
        |--------------------------------------------------------------------------
        */

        User::create([
            'uuid' => generateUuidKey(),
            'merchant_uuid' => $pizza->uuid,
            'name' => 'Pizza Admin',
            'email' => 'pizza.admin@demo.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'uuid' => generateUuidKey(),
            'merchant_uuid' => $burger->uuid,
            'name' => 'Burger Admin',
            'email' => 'burger.admin@demo.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        /*
        |--------------------------------------------------------------------------
        | CATEGORIES (PER MERCHANT)
        |--------------------------------------------------------------------------
        */

        $categories = [
            'Burgers',
            'Pizza',
            'Fries',
            'Drinks',
            'Desserts',
        ];

        // Pizza Merchant Categories
        foreach ($categories as $cat) {
            ProductCategory::create([
                'uuid' => generateUuidKey(),
                'merchant_uuid' => $pizza->uuid,
                'name' => $cat,
            ]);
        }

        // Burger Merchant Categories
        foreach ($categories as $cat) {
            ProductCategory::create([
                'uuid' => generateUuidKey(),
                'merchant_uuid' => $burger->uuid,
                'name' => $cat,
            ]);
        }
    }
}
