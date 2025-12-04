<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@psyanon.local'],
            [
                'name' => 'Admin',
                'password' => bcrypt('psy@n0n2025'), // Смени в продакшене!
                'role' => 'admin'
            ]
        );
    }
}
