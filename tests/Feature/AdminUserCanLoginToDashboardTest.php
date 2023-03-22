<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminUserCanLoginToDashboardTest extends TestCase
{
    /**
     * Authenticate as an admin user and log in to the dashboard
     */
    public function test_admin_user_can_login_to_dashboard()
    {
        $this->seed();

        $response = $this->post('/login', [
            'email' => 'admin@admin.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/dashboard');

        $this->assertAuthenticated();
    }
}
