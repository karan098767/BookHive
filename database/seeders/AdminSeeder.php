<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::factory()->create([
            'first_name' => 'System',
            'last_name'  => 'Admin',
            'email'      => 'admin@example.com',
            'password'   => Hash::make('password'),
            'is_active'  => true,
        ]);
    }
}
