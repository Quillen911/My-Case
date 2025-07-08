<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'İsmail',
            'email' => 'hecksoft0@gmail.com',
            'password' => Hash::make('ismail'),
        ]);
    }
} 