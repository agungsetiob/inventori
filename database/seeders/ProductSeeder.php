<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('products')->insert([
            'name' => "Pulpen",
            'category_id'=> 1,
            'price'=> 5000,
            'stock'=> 100
        ]);
        DB::table('products')->insert([
            'name' => "Sapu",
            'category_id'=> 3,
            'price'=> 15000,
            'stock'=> 100
        ]);
        DB::table('products')->insert([
            'name' => "Tabung Oksigen",
            'category_id'=> 2,
            'price'=> 1500000,
            'stock'=> 100
        ]);
    }
}
