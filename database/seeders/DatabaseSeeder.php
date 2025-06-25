<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Employee::factory(10)->create();

        User::factory()->create([
            'name' => 'Director',
            'email' => 'director@gmail.com',
            'role' => 'director'
        ]);

        User::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@gmail.com',
            'role' => 'manager'
        ]);

        User::factory()->create([
            'name' => 'Finance',
            'email' => 'finance@gmail.com',
            'role' => 'finance'
        ]);
    }
}
