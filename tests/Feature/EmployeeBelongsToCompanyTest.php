<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeBelongsToCompanyTest extends TestCase
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
     * When showing an employee, the company is also fetched
     */
    public function test_employee_show_route_fetches_company()
    {
        // factory up a company
        $company = \App\Models\Company::factory()->create();

        // factory up an employee for the company
        $employee = \App\Models\Employee::factory()
            ->for($company)
            ->create();

        // fetch the employee from the show route
        $response = $this->get('/employees/' . $employee->id);

        // assert that the employee's company is also fetched
        $response->assertInertia(function ($inertia) use ($company) {
            $inertia->has('employee.data.company.name');
        });
    }
}
