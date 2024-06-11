<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создание пользователей с соответствующими ролями
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        $moderator = User::create([
            'name' => 'Moderator',
            'email' => 'moderator@admin.com',
            'role' => 'moderator',
            'password' => bcrypt('password'),
        ]);
    }
}
