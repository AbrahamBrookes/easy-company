<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyHasManyEmployeesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * On setup auth as admin
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(\App\Models\User::factory()->admin()->create());
    }

    /**
     * A Company can have many employees
     */
    public function test_company_has_many_employees()
    {
        // factory up a company
        $company = \App\Models\Company::factory()->create();

        // factory up 5 employees for the company
        $employees = \App\Models\Employee::factory()
            ->count(5)
            ->for($company)
            ->create();

        // assert that the company has 5 employees
        $this->assertEquals(5, $company->employees()->count());
    }

    /**
     * When fetching a company from the show route, the company's employees are also fetched
     */
    public function test_company_show_route_fetches_employees()
    {
        // factory up a company
        $company = \App\Models\Company::factory()->create();

        // factory up 5 employees for the company
        $employees = \App\Models\Employee::factory()
            ->count(5)
            ->for($company)
            ->create();

        // fetch the company from the show route
        $response = $this->get('/companies/' . $company->id);

        // assert that the company's employees are also fetched
        $response->assertInertia(function ($inertia) use ($employees) {
            $inertia->has('company.data', function ($company) use ($employees) {
                $company->has('employees', $employees->count());
                $company->has('id');
                $company->has('name');
                $company->has('email');
                $company->has('logo');
                $company->has('website');
            });
        });
    }
}
