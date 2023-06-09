<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyResourceRoutesTest extends TestCase
{
    use RefreshDatabase;

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

        // paginated responses force wrapping with 'data'
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
     * Create /companies/create
     * - should be an inertia response
     * - that's it really
     */
    public function test_create_company_route_serves_ok()
    {
        // go to create
        $response = $this->get('/companies/create');

        $response->assertStatus(200);

        $response->assertInertia();
    }

    /**
     * Store /companies
     * - should persist the data
     * - should redirect to the show route
     * - should be an inertia response
     * - should have the company data
     */
    public function test_store_company_route_serves_ok()
    {
        // spawn a company
        $company = \App\Models\Company::factory()->make();

        // store it
        $response = $this->post('/companies', $company->toArray());

        // check that the company was created
        $this->assertDatabaseHas('companies', [
            "name" => $company->name,
            "email" => $company->email,
            "website" => $company->website,
        ]);
    }

    public function test_store_company_route_redirects_to_show_route()
    {
        // spawn a company
        $company = \App\Models\Company::factory()->make();

        // store
        $response = $this->post('/companies', $company->toArray());

        // find the company in the database
        $company = \App\Models\Company::where('email', $company->email)->first();

        // check that we were redirected to the show route
        $response->assertRedirect('/companies/' . $company->id);
    }

    public function test_store_company_route_has_company_data()
    {
        // spawn a company
        $company = \App\Models\Company::factory()->make();

        // store
        $response = $this->post('/companies', $company->toArray());

        // find the company in the database
        $company = \App\Models\Company::where('email', $company->email)->first();

        $redirectedResponse = $this->followRedirects($response);

        $redirectedResponse->assertInertia(function ($inertia) use ($company) {
            $inertia->has('company', function ($inertia) use ($company) {
                $inertia->where('id', $company->id);
                $inertia->where('name', $company->name);
                $inertia->where('email', $company->email);
                $inertia->where('website', $company->website);
                $inertia->has('employees');
                $inertia->has('logo');
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
            $inertia->where('company.id', $company->id);
            $inertia->where('company.name', $company->name);
            $inertia->where('company.logo', $company->logo);
            $inertia->where('company.website', $company->website);
            $inertia->where('company.email', $company->email);
            $inertia->has('company.employees');
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
            $inertia->has('company.employees');

            $inertia->has('company.employees.0', function ($inertia) {
                $inertia->has('id');
                $inertia->has('first_name');
                $inertia->has('last_name');
                $inertia->has('email');
                $inertia->has('phone');
                $inertia->has('company_id');
            });
        });
    }

    /**
     * Update /companies/{id}
     * - should persist the data
     * - should redirect to the show route
     */
    public function test_update_company_route_persists_data()
    {
        // spawn a company
        $company = \App\Models\Company::factory()->create();

        // update
        $response = $this->put('/companies/' . $company->id, $company->toArray());

        // check that the company was updated
        $this->assertDatabaseHas('companies', [
            "name" => $company->name,
            "email" => $company->email,
            "website" => $company->website,
        ]);
    }

    public function test_update_company_route_redirects_to_show_route()
    {
        // spawn a company
        $company = \App\Models\Company::factory()->create();

        // update
        $response = $this->put('/companies/' . $company->id, $company->toArray());

        // check that we were redirected to the show route
        $response->assertRedirect('/companies/' . $company->id);
    }

    /**
     * Delete /companies/{id}
     * - should delete the company
     * - should redirect to the index route
     */
    public function test_delete_company_route_deletes_company()
    {
        // spawn a company
        $company = \App\Models\Company::factory()->create();

        // delete
        $response = $this->delete('/companies/' . $company->id);

        // check that the company was deleted (softdelete)
        $this->assertSoftDeleted('companies', [
            "name" => $company->name,
            "email" => $company->email,
            "website" => $company->website,
        ]);
    }

    public function test_delete_company_route_redirects_to_index_route()
    {
        // spawn a company
        $company = \App\Models\Company::factory()->create();

        // delete
        $response = $this->delete('/companies/' . $company->id);

        // check that we were redirected to the index route
        $response->assertRedirect('/companies');
    }

    /**
     * We must be authenticated to access any of these resource routes
     */
    public function test_resource_routes_require_authentication()
    {
        // log out
        auth()->logout();

        // spawn a company
        $company = \App\Models\Company::factory()->create();

        // fudge an image file as the logo
        $company->logo = \Illuminate\Http\UploadedFile::fake()->image('logo.png', 100, 100);

        // index
        $response = $this->get('/companies');
        $response->assertRedirect('/login');

        // create
        $response = $this->get('/companies/create');
        $response->assertRedirect('/login');

        // store
        $response = $this->post('/companies', $company->toArray());
        $response->assertRedirect('/login');

        // show
        $response = $this->get('/companies/' . $company->id);
        $response->assertRedirect('/login');

        // update
        $response = $this->put('/companies/' . $company->id, $company->toArray());
        $response->assertRedirect('/login');

        // delete
        $response = $this->delete('/companies/' . $company->id);
        $response->assertRedirect('/login');

        // log back in
        $this->actingAs(\App\Models\User::factory()->admin()->create());

        // index
        $response = $this->get('/companies');
        $response->assertStatus(200);

        // create
        $response = $this->get('/companies/create');
        $response->assertStatus(200);

        // store
        $response = $this->post('/companies', $company->toArray());
        $response->assertStatus(302);
        // show
        $response = $this->get('/companies/' . $company->id);
        $response->assertStatus(200);

        // update
        $response = $this->put('/companies/' . $company->id, $company->toArray());
        $response->assertStatus(302);

        // delete
        $response = $this->delete('/companies/' . $company->id);
        $response->assertStatus(302);
    }
}
