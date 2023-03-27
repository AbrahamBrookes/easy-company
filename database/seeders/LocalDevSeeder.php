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

        // don't do this for testing - too slow
        if (! app()->environment('testing')) {
            // factory up 50 companies with 0 to 10 employees
            // but don't allow emails to be sent out
            \App\Models\Company::unsetEventDispatcher();

            \App\Models\Company::factory()
                ->count(rand(32, 64))
                ->create()
				->each(function($company){
					for($i = 0; $i < rand(0, 100); $i++){
						\App\Models\Employee::factory()
							->for($company)
							->create();
					}
				});
        }
    }
}
