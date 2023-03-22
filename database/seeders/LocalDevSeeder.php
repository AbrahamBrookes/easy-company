<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LocalDevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create an admin user
		\App\Models\User::factory()->admin()->create([
			'name' => 'Admin',
			'email' => 'admin@admin.com',
			'password' => Hash::make('password'),
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);
    }
}