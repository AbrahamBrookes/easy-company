<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Http\Resources\CompanyResource;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // paginated 10 per page
        return inertia('Company/Index', [
            'companies' => CompanyResource::collection(Company::paginate(10)),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        $company = Company::create($request->validated());

        // redirect to show
        return redirect()->route('companies.show', $company);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        // show our inertia Pages/Company/Show view
        return inertia('Company/Show', [
            'company' => new CompanyResource($company->load('employees')),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company->update($request->validated());

        // redirect to show
        return redirect()->route('companies.show', $company);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        // delete the company as well as its logo from storage
        $company->delete();

        // redirect to index
        return redirect()->route('companies.index');
    }
}
