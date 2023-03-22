<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UnauthenticatedUsersRedirectToLoginTest extends TestCase
{
    /**
     * Unauthenticated users get redirected to login if they try to access our protected area
     */
    public function test_unauthenticated_users_redirect_to_login()
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }
}
