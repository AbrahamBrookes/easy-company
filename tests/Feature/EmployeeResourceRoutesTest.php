<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeResourceRoutesTest extends TestCase
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
     * List: /employees
     *  - should be paginated
     *  - should be an inertia response
     */

    public function test_list_employees_route_serves_ok()
    {
        // go to list
        $response = $this->get('/employees');

        $response->assertStatus(200);
    }

    // test paginated 10
    public function test_list_employees_route_paginates_ten()
    {
        // spawn 50 employees
        \App\Models\Employee::factory()
            ->count(50)
            ->for(\App\Models\Company::factory())
            ->create();

        // go to list
        $response = $this->get('/employees');

        $response->assertInertia(function ($inertia) {
            $inertia->has('employees.data');
            // count 10
            $inertia->has('employees.data', 10);

            $inertia->has('employees.data.0', function ($inertia) {
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
     * Create /employees/create
     * - should be an inertia response
     * - that's it really
     */
    public function test_create_employee_route_serves_ok()
    {
        // go to create
        $response = $this->get('/employees/create');

        $response->assertStatus(200);

        $response->assertInertia();
    }

    /**
     * Show /employees/{id}
     *  - should be an inertia response
     *  - should have the employee data
     *  - should have the employee's company
     */
    public function test_show_employee_route_serves_ok()
    {
        // spawn an employee
        $employee = \App\Models\Employee::factory()
            ->for(\App\Models\Company::factory())
            ->create();

        // go to show
        $response = $this->get('/employees/' . $employee->id);

        $response->assertStatus(200);
    }

    public function test_show_employee_route_has_employee_data()
    {
        // spawn an employee
        $employee = \App\Models\Employee::factory()
            ->for(\App\Models\Company::factory())
            ->create();

        // go to show
        $response = $this->get('/employees/' . $employee->id);

        $response->assertInertia(function ($inertia) use ($employee) {
            $inertia->has('employee.data', function ($inertia) use ($employee) {
                $inertia->where('id', $employee->id);
                $inertia->where('first_name', $employee->first_name);
                $inertia->where('last_name', $employee->last_name);
                $inertia->where('email', $employee->email);
                $inertia->where('phone', $employee->phone);
                $inertia->where('company_id', $employee->company_id);
                $inertia->has('company');
            });
        });
    }

    public function test_show_employee_route_has_employee_company()
    {
        // spawn an employee
        $employee = \App\Models\Employee::factory()
            ->for(\App\Models\Company::factory())
            ->create();

        // go to show
        $response = $this->get('/employees/' . $employee->id);

        $response->assertInertia(function ($inertia) use ($employee) {
            $inertia->has('employee.data.company', function ($inertia) use ($employee) {
                $inertia->where('id', $employee->company->id);
                $inertia->where('name', $employee->company->name);
                $inertia->where('logo', $employee->company->logo);
                $inertia->where('website', $employee->company->website);
                $inertia->where('email', $employee->company->email);
            });
        });
    }

    /**
     * Store /employees
     * - should persist the data
     * - should redirect to the show route
     * - should be an inertia response
     * - should return the new employees data
     */
    public function test_store_employee_route_persists_data()
    {
        // spawn a company so we can get its id
        $company = \App\Models\Company::factory()->create();

        // spawn an employee
        $employee = \App\Models\Employee::factory()
            ->for($company)
            ->make();

        // go to store
        $response = $this->post('/employees', $employee->toArray());

        // check that the employee was created
        $this->assertDatabaseHas('employees', $employee->toArray());
    }

    public function test_store_employee_route_redirects_to_show_route()
    {
        // spawn a company so we can get its id
        $company = \App\Models\Company::factory()->create();

        // spawn an employee
        $employee = \App\Models\Employee::factory()
            ->for($company)
            ->make();

        // store
        $response = $this->post('/employees', $employee->toArray());

        // find the employee in the database
        $employee = \App\Models\Employee::where('email', $employee->email)->first();

        // check that we were redirected to the show route
        $response->assertRedirect('/employees/' . $employee->id);
    }

    public function test_store_employee_route_has_employee_data()
    {
        // spawn a company so we can get its id
        $company = \App\Models\Company::factory()->create();

        // spawn an employee
        $employee = \App\Models\Employee::factory()
            ->for($company)
            ->make();

        // store
        $response = $this->post('/employees', $employee->toArray());

        // find the employee in the database
        $employee = \App\Models\Employee::where('email', $employee->email)->first();

        $redirectedResponse = $this->followRedirects($response);

        $redirectedResponse->assertInertia(function ($inertia) use ($employee) {
            $inertia->has('employee.data', function ($inertia) use ($employee) {
                $inertia->where('id', $employee->id);
                $inertia->where('first_name', $employee->first_name);
                $inertia->where('last_name', $employee->last_name);
                $inertia->where('email', $employee->email);
                $inertia->where('phone', $employee->phone);
                $inertia->where('company_id', $employee->company_id);
                $inertia->has('company');
            });
        });
    }




}
