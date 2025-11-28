<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@silentvoice.local'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password123'), // Смени в продакшене!
                'role' => 'admin'
            ]
        );
    }
}
