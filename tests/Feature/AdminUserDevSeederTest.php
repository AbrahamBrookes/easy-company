<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminUserDevSeederTest extends TestCase
{
    use RefreshDatabase;
    /**
     * After running a migrate fresh and seed in a testing or local environment, we
     * should have an admin user seeded with the email: admin@admin.com
     */
    public function test_admin_user_dev_seeder()
    {
        $this->seed();

        $this->assertDatabaseHas('users', [
            'email' => 'admin@admin.com',
            'is_admin' => true,
        ]);
    }
}
