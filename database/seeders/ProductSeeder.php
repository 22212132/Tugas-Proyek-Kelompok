<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
    [
        'name' => 'Nasi Goreng Spesial',
        'description' => 'Nasi goreng dengan telur, ayam suwir, dan kerupuk gurih.',
        'price' => 25000,
        'stock' => 20,
        'image' => 'https://picsum.photos/seed/nasigoreng/200/200',
    ],
    [
        'name' => 'Mie Ayam Bakso',
        'description' => 'Mie ayam dengan bakso kenyal dan kuah kaldu gurih.',
        'price' => 20000,
        'stock' => 15,
        'image' => 'https://picsum.photos/seed/mieayam/200/200',
    ],
    [
        'name' => 'Es Teh Manis',
        'description' => 'Minuman segar teh manis dingin, cocok untuk segala suasana.',
        'price' => 5000,
        'stock' => 50,
        'image' => 'https://picsum.photos/seed/esteh/200/200',
    ],
]);

    }
}
