<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanySoftDeletesTest extends TestCase
{
    /**
     * Always softdelete unless otherwise specified!
     */
    public function test_company_softdeletes()
    {
        // factory up a company
        $company = \App\Models\Company::factory()->create();

        // soft delete the company
        $company->delete();

        // assert that the company is soft deleted
        $this->assertSoftDeleted('companies', [
            'name' => $company->name,
            'email' => $company->email,
            'logo' => $company->logo,
            'website' => $company->website,
        ]);
    }
}
