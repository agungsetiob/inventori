<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('suppliers')->insert([
            'name' => "Andika",
            'address' => "Simpang",
            'phone'=>'08123456789',
            'email'=>'simpang@gmailcom'
        ]);

        DB::table('suppliers')->insert([
            'name' => "Agung Joyo",
            'address' => "Batulicin",
            'phone'=>'08123456789',
            'email'=>'batulicin@gmailcom'
        ]);
    }
}
