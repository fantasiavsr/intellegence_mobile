<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'teacher-01',
            'username' => 'teacher01', // Add this line
            'email' => 'teacher-01@gmail.com',
            'password' => 'password',
            'phone_number' => '081234567890',
            'level' => 'teach',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'student-01',
            'username' => 'student01', // Add this line
            'email' => 'student-01@gmail.com',
            'password' => bcrypt('password'),
            'phone_number' => '081234567890',
            'level' => 'student',
        ]);
    }
}
