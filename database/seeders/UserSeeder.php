<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'isAdmin' => true,
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'Guest',
            'email' => 'guest@guest.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
