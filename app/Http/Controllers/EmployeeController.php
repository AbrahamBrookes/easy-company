<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Http\Resources\EmployeeResource;
use App\Models\Company;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // paginated 10 per page
        return Inertia::render('Employee/Index', [
            'employees' => EmployeeResource::collection(Employee::paginate(10)),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * Pass a company to pre-select a company_id
     */
    public function create(Company $company = null)
    {
        // show our inertia Pages/Employee/Create view
        return Inertia::render('Employee/Create', [
            'companies' => Company::select("id", "name")->get(),
            'company' => $company,
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
        return Inertia::render('Employee/Show', [
            'employee' => new EmployeeResource($employee->load('company')),
			// only load companies if the employees company_id is null
			'companies' => $employee->company ? [] : Company::select("id", "name")->get(),
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
