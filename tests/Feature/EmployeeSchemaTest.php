<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeSchemaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Our app has an Employee model which musty exist and match a specified schema
     */
    public function test_employee_schema()
    {
        // factory up an employee
        $employee = \App\Models\Employee::factory()
            ->for(\App\Models\Company::factory())
            ->create();

        $this->assertDatabaseHas('employees', [
            'first_name' => $employee->first_name,
            'last_name' => $employee->last_name,
            'email' => $employee->email,
            'phone' => $employee->phone,
        ]);
    }
}
