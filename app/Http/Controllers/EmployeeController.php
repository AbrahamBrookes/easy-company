<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // light list (just name and id) paginated 10 per page
        return inertia('Employee/Index', [
            'employees' => Employee::select('id', 'first_name', 'last_name')->paginate(10),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employee = Employee::create($request->validated());

        // redirect to show
        return redirect()->route('employees.show', $employee);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        // show our inertia Pages/Employee/Show view
        return inertia('Employee/Show', [
            'employee' => $employee,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());

        // redirect to show
        return redirect()->route('employees.show', $employee);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        // delete the employee
        $employee->delete();

        // redirect to index
        return redirect()->route('employees.index');
    }
}
