<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cart;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CartSeeder::class
        ]);
    }
}
