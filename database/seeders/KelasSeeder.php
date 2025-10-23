<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('classes')->insert([
            ['name' => 'X TKJ 1', 'level' => 'X'],
            ['name' => 'X TKJ 2', 'level' => 'X'],
            ['name' => 'X AKL', 'level' => 'X'],
            ['name' => 'X BID', 'level' => 'X'],

            ['name' => 'XI TKJ 1', 'level' => 'XI'],
            ['name' => 'XI TKJ 2', 'level' => 'XI'],
            ['name' => 'XI TKJ 3', 'level' => 'XI'],
            ['name' => 'XI AKL', 'level' => 'XI'],
            ['name' => 'XI BID', 'level' => 'XI'],

            ['name' => 'XII AKL 1', 'level' => 'XII'],
            ['name' => 'XII AKL 2', 'level' => 'XII'],
            ['name' => 'XII BID', 'level' => 'XII'],
            ['name' => 'XII TKJ 1', 'level' => 'XII'],
            ['name' => 'XII TKJ 2', 'level' => 'XII'],
            ['name' => 'XII TKJ 3', 'level' => 'XII'],
        ]);
    }
}