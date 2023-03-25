<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;
use Tests\TestCase;

class BaseUrlServesTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        // home page should redirect to login
        $response = $this->get('/');
        $response->assertStatus(302);
        $response->assertRedirect('/login');

        // login as admin
        $response = $this->actingAs(User::factory()->admin()->create())->get('/');

        // should redirect to dashboard
        $response = $this->get('/');
        $response->assertStatus(302);
        $response->assertRedirect('/dashboard');
    }
}
