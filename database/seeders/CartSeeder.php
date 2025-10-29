<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Cart;
use Faker\Factory as Faker;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');


        if (Product::count() == 0) {
            for ($i = 1; $i <= 5; $i++) {
                Product::create([
                    'name' => $faker->words(2, true),
                    'description' => $faker->sentence(8),
                    'price' => $faker->numberBetween(50000, 250000),
                    'stock' => $faker->numberBetween(5, 50),
                    'image' => 'https://via.placeholder.com/150?text=Produk+' . $i,
                ]);
            }
        }

        $products = Product::all();

        foreach ($products as $product) {
            Cart::create([
                'user_id' => 1, // ubah sesuai user kamu
                'product_id' => $product->id,
                'quantity' => $faker->numberBetween(1, 5),
                'selected' => $faker->boolean(70),
            ]);
        }
    }
}
