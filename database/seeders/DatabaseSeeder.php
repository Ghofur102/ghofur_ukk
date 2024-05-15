<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'username' => 'Galang',
            'fullname' => 'Galang',
            'address' => 'Banyuwangi',
            'email' => 'galang@gmail.com',
            'password' => bcrypt('galang123'),
        ]);
        User::create([
            'username' => 'Ghofur',
            'fullname' => 'Ghofur',
            'address' => 'Banyuwangi',
            'email' => 'ghofur@gmail.com',
            'password' => bcrypt('ghofur123'),
        ]);
        User::create([
            'username' => 'Reyhan',
            'fullname' => 'Reyhan',
            'address' => 'Banyuwangi',
            'email' => 'reyhan@gmail.com',
            'password' => bcrypt('reyhan123'),
        ]);
    }
}
