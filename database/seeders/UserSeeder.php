<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => "Administrator",
            'email' => "admin@gmail.com",
            'password'=>Hash::make('admin'),
            'role'=>'admin'
        ]);

        DB::table('users')->insert([
            'name' => "Cemara",
            'email' => "cemara@gmail.com",
            'password'=>Hash::make('cemara'),
            'role'=>'officer'
        ]);
        DB::table('users')->insert([
            'name' => "Rajal",
            'email' => "rajal@gmail.com",
            'password'=>Hash::make('rajal'),
            'role'=>'officer'
        ]);
        DB::table('users')->insert([
            'name' => "Ranap",
            'email' => "ranap@gmail.com",
            'password'=>Hash::make('ranap'),
            'role'=>'officer'
        ]);
    }
}
