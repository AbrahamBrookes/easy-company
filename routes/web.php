<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware('auth')->group(function () {

    // / should redirect to dashboard
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard', [
            "numCompanies" => \App\Models\Company::count(),
            "numEmployees" => \App\Models\Employee::count()
        ]);
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // resource routes for Company
    Route::resource('companies', \App\Http\Controllers\CompanyController::class);

    // resource routes for Employee
    Route::resource('employees', \App\Http\Controllers\EmployeeController::class);

    // a route for creating employees with a pre-selected company
    Route::get('/companies/{company}/employees/create', [\App\Http\Controllers\EmployeeController::class, 'create'])->name('employees.create.for-company');
});

require __DIR__.'/auth.php';
