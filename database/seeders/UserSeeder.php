<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'team_id' => null,
        ]);

        // Team Lead user
        User::create([
            'name' => 'Team Lead',
            'email' => 'lead@example.com',
            'password' => Hash::make('password'),
            'role' => 'team_lead',
            'team_id' => 1,
        ]);

        // Team Member user
        User::create([
            'name' => 'Team Member',
            'email' => 'member@example.com',
            'password' => Hash::make('password'),
            'role' => 'team_member',
            'team_id' => 1,
        ]);

        // Optional: create 5 random users
        User::factory(5)->create();
    }
}
