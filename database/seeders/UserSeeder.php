<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'iso',
            'email' => 'hecksoft0@gmail.com',
            'password' => bcrypt('ismail'),
        ]);
    }
}
