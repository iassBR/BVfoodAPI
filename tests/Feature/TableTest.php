<?php

namespace Tests\Feature;

use App\Models\{
    Tenant,
    Table
};

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TableTest extends TestCase
{
   /**
     * Error Get Tables by Tenant
     *
     * @return void
     */
    public function testErrorGetAllTablesByTenant()
    {
        $response = $this->getJson('/api/v1/tables');

        $response->assertStatus(422);
    }

    /**
     * Get Tables by Tenant
     *
     * @return void
     */
    public function testGetAllTablesByTenant()
    {
        $tenant = Tenant::factory()->create();

        $response = $this->getJson("/api/v1/tables?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }

    /**
     * Error Get Table by Identify
     *
     * @return void
     */
    public function testErrorGetTableByIdentify()
    {
        $table = 'd9743eaa-57bd-4e76-afca-ca3dbfb25800';

        $tenant = Tenant::factory()->create();

        $response = $this->getJson("/api/v1/tables/{$table}?token_company={$tenant->uuid}");

        $response->assertStatus(404);
    }


    /**
     * Get Table by Identify
     *
     * @return void
     */
    public function testGetTableByIdentify()
    {
        $table = Table::factory()->create();

        $tenant = Tenant::factory()->create();

        $response = $this->getJson("/api/v1/tables/{$table->uuid}?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }
}
