<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        User::create([
            'name' => 'Amherst Admin',
            'email' => 'admin@amherstcollege.edu',
            'password' => Hash::make('testpass'),
            'is_admin' => true,
        ]);

        for ($i = 0; $i < 2; $i++) {
            User::create([
                'name' => 'Admin User' . $i,
                'email' => 'adminuser' . $i .'@amherstcollege.edu',
                'password' => Hash::make('testpass'),
                'is_admin' => true,
            ]);

        }

        for ($i = 0; $i < 5; $i++) {
            User::create([
                'name' => 'Regular User' . $i,
                'email' => 'regularuser' . $i .'@amherstcollege.edu',
                'password' => Hash::make('testpass'),
                'is_admin' => false,
            ]);

        }
    }
}
