<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // if we are in a local or testing environment, run the local dev seeder
        if (app()->environment('local', 'testing')) {
            $this->call(LocalDevSeeder::class);
        }
    }
}
