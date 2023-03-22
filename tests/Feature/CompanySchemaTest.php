<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanySchemaTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Our app has a Company model which musty exist and match a specified schema
     */
    public function test_company_schema()
    {
        // factory up a company
        $company = \App\Models\Company::factory()->create();

        $this->assertDatabaseHas('companies', [
            'name' => $company->name,
            'email' => $company->email,
            'logo' => $company->logo,
            'website' => $company->website,
        ]);
    }
}
