<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeSoftDeletesTest extends TestCase
{
    /**
     * Always softdelete unless otherwise specified!
     */
    public function test_employee_softdeletes()
    {
        // factory up an employee
        $employee = \App\Models\Employee::factory()
            ->for(\App\Models\Company::factory())
            ->create();

        // soft delete the employee
        $employee->delete();

        // assert that the employee is soft deleted
        $this->assertSoftDeleted('employees', [
            'first_name' => $employee->first_name,
            'last_name' => $employee->last_name,
            'email' => $employee->email,
            'phone' => $employee->phone,
        ]);
    }
}
