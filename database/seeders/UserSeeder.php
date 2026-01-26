<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create one Admin
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@fitness.com',
            'password' => Hash::make('password123'),
            'role_id' => 1, // Points to 'Admin'
        ]);

        // Create one Dummy Member
        User::create([
            'name' => 'Hakimi Halim',
            'email' => 'Hakimi@gmail.com',
            'password' => Hash::make('password123'),
            'role_id' => 2, // Points to 'Member'
        ]);
    }
}
