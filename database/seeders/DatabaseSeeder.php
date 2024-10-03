<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\StudentFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Teachers
        User::factory(10)
            ->create()
            ->each(function ($user) {
                Teacher::create([
                    'user_id' => $user->id
                ]);
            });

        // Students //
        User::factory(10)
            ->create(['role' => Role::Student])
            ->each(function ($user) {
                Student::factory()->create([
                    'user_id' => $user->id
                ]);
            });

        // Admins //
        User::factory(4)->create(['role' => Role::Admin]);
        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'role' => Role::Admin
        ]);
    }
}
