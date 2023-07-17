<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        // Bankasu5 users
        DB::table('users')->insert([
            'name' => 'Jurgita',
            'email' => 'jurgita@bank5.test',
            'password' => Hash::make('12345678'),
        ]);
        DB::table('users')->insert([
            'name' => 'darbuotojas12',
            'email' => 'darbuotojas12@bank5.test',
            'password' => Hash::make('123'),
        ]);
    }
}