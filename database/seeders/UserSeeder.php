<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate([
            'email' => 'hecksoft0@gmail.com',
        ], [
            'username' => 'İsmail',
            'password' => Hash::make('ismail'),
            'is_admin' => true,
        ]);
        User::firstOrCreate([
            'email' => 'hecksoft00@gmail.com',
        ], [
            'username' => 'iso',
            'password' => Hash::make('ismaiL0'),
            'is_admin' => true,
        ]);
    }
} 