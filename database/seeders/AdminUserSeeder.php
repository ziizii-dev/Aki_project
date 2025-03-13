<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
// database/seeders/AdminUserSeeder.php
public function run()
{
    if (!Admin::where('email', 'admin@mail.test')->exists()) {
        Admin::create([
            'email' => 'admin@mail.test',
            'password' => Hash::make('Password1234'),
        ]);
    }
}

    }
