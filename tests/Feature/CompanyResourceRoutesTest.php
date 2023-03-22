<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyResourceRoutesTest extends TestCase
{
    /**
     * In setup, auth as admin
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->actingAs(\App\Models\User::factory()->admin()->create());
    }

    /**
     * List: /companies
     *  - should be paginated
     *  - should be an inertia response
     */
    public function test_list_companies_route_serves_ok()
    {
        // go to list
        $response = $this->get('/companies');

        $response->assertStatus(200);
    }

    // test paginated 10
    public function test_list_companies_route_paginates_ten()
    {
        // spawn 50 companies
        \App\Models\Company::factory()->count(50)->create();

        // go to list
        $response = $this->get('/companies');

        $response->assertInertia(function ($inertia) {
            $inertia->has('companies.data');
            // count 10
            $inertia->has('companies.data', 10);

            $inertia->has('companies.data.0', function ($inertia) {
                $inertia->has('id');
                $inertia->has('name');
                $inertia->has('logo');
                $inertia->has('website');
                $inertia->has('email');
            });
        });
    }

    /**
     * Show /companies/{id}
     *  - should be an inertia response
     *  - should have the company data
     *  - should have the company's employees
     */
    public function test_show_company_route_serves_ok()
    {
        // spawn a company
        $company = \App\Models\Company::factory()->create();

        // go to show
        $response = $this->get('/companies/' . $company->id);

        $response->assertStatus(200);
    }

    public function test_show_company_route_has_company_data()
    {
        // spawn a company
        $company = \App\Models\Company::factory()->create();

        // go to show
        $response = $this->get('/companies/' . $company->id);

        $response->assertInertia(function ($inertia) use ($company) {
            // values match
            $inertia->where('company.data.id', $company->id);
            $inertia->where('company.data.name', $company->name);
            $inertia->where('company.data.logo', $company->logo);
            $inertia->where('company.data.website', $company->website);
            $inertia->where('company.data.email', $company->email);
            $inertia->has('company.data.employees');
        });
    }

    public function test_show_company_route_has_company_employees()
    {
        // spawn a company
        $company = \App\Models\Company::factory()
            ->has(\App\Models\Employee::factory()->count(10))
            ->create();

        // spawn 10 employees
        \App\Models\Employee::factory()->count(10)->for($company)->create();

        // go to show
        $response = $this->get('/companies/' . $company->id);

        $response->assertInertia(function ($inertia) {
            $inertia->has('company.data.employees');

            $inertia->has('company.data.employees.0', function ($inertia) {
                $inertia->has('id');
                $inertia->has('first_name');
                $inertia->has('last_name');
                $inertia->has('email');
                $inertia->has('phone');
                $inertia->has('company_id');
            });
        });
    }

}
