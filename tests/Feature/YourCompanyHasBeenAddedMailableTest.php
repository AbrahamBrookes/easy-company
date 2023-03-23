<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Mail\YourCompanyHasBeenAdded;

class YourCompanyHasBeenAddedMailableTest extends TestCase
{
    /**
     * When a new company is created, they should get an email.
     */
    public function test_company_gets_email_on_creation()
    {
        Mail::fake();

        // make a company
        $company = \App\Models\Company::factory()->create();

        // assert that the Company got their mail
        Mail::assertSent(YourCompanyHasBeenAdded::class, function ($mail) use ($company) {
            return $mail->hasTo($company->email);
        });

    }


}
