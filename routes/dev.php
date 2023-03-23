<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Notification;

/**
 * These routes are protected by the DevEnvironmentOnly middleware, registered in the
 * RouteServiceProvider and Http Kernel. These routes are only visible if the app env
 * is set to 'local'.
*/

Route::prefix('mail')->group(function () {
    Route::get('/your-company-has-been-added', function () {
        $company = \App\Models\Company::factory()->create();

        return new App\Mail\YourCompanyHasBeenAdded($company);
    });
});
