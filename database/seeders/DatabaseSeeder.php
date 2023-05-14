<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Register;
use App\Models\User;
use Illuminate\Database\Seeder;

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
            'name' => 'Danny',
            'password' => \bcrypt('password'),
            'lastname' => 'Medina',
            'email' => 'danny_2003@ovi.com'
        ]);
        
        
        User::create([
            'name' => 'Juan Pablo',
            'password' => \bcrypt('password'),
            'lastname' => 'Peréz Garcia',
            'email' => 'example@example.com'
        ]);

        User::create([
            'name' => 'Maria Soledad',
            'password' => \bcrypt('password'),
            'lastname' => 'Uc Loria',
            'email' => 'example2@example.com'
        ]);

        Register::factory(40)->create([
            'user_id' => 2
        ]);
        Register::factory(40)->create([
            'user_id' => 3
        ]);
    }
}
