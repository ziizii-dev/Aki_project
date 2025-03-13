<?php

// database/seeders/UsersTableSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'test@mail.test'], // Check if this user already exists
            [
                'name' => 'Test User',
                'password' => bcrypt('Password1234'), // Set the password
            ]
        );
    }
}
