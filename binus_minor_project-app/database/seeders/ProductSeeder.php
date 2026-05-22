<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
    
        Product::create([
            'name' => 'Black Oversize T-Shirt',
            'description' => 'A 100% organic cotton T-shirt with a comfortable, modern fit.',
            'price' => 300000,
            'stock' => 50,
            'image_url' => 'https://www.screamous.com/cdn/shop/products/ginee_20230308170958980_3916430722_1200x1200.jpg?v=1678266615'
        ]);

        Product::create([
            'name' => 'Blue Slim-Fit Jeans',
            'description' => 'Classic slim-fit jeans with a touch of spandex for comfort.',
            'price' => 500000,
            'stock' => 30,
            'image_url' => 'https://equatorstores.com/cdn/shop/products/EQ-DJ-S23-03-SBL_2.jpg?v=1755094424'
        ]);

        Product::create([
            'name' => 'Vintage Denim Jacket',
            'description' => '90s-style denim jacket, light wash.',
            'price' => 700000,
            'stock' => 20,
            'image_url' => 'https://preloved.co.id/_ipx/w_800,f_webp,q_80,fit_cover/https://assets.preloved.co.id/products/117556/df44c67f-0427-442e-a7bd-7a29dec82ffe.jpg'
        ]);
    }
}