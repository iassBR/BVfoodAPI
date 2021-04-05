<?php

namespace Tests\Feature;

use App\Models\{
    Tenant
};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TenantTest extends TestCase
{
    /**
     * Test Get All Tenants.
     *
     * @return void
     */
    public function test_GetAllTenants()
    {
        Tenant::factory(10)->create();

        $response = $this->getJson('/api/v1/tenants');

        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }

    /**
     * Test Get Error Sigle Tenant.
     *
     * @return void
     */
    public function test_ErrorGetTenant()
    {
        // $tenant = Tenant::factory(1)->create();
        $tenant = 'd9743eaa-57bd-4e76-afca-ca3dbfb25800';

        $response = $this->getJson("/api/v1/tenants/{$tenant}");


        $response->assertStatus(404);
    }


     /**
     * Test Get Single Tenant By identify.
     *
     * @return void
     */
    public function test_GetTenantByIdentify()
    {
        $tenant = Tenant::factory()->create();

        $response = $this->getJson("/api/v1/tenants/{$tenant->uuid}");

        $response->assertStatus(200);
    }
}
