<?php

namespace Tests\Feature;

use App\Models\{
    Tenant,
    Category
};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * Error Get Categories by Tenant
     *
     * @return void
     */
    public function testErrorGetAllCategoriesByTenant()
    {
        $response = $this->getJson('/api/v1/categories');

        $response->assertStatus(422);
    }

    /**
     * Get Categories by Tenant
     *
     * @return void
     */
    public function testGetAllCategoriesByTenant()
    {
        $tenant = Tenant::factory()->create();

        $response = $this->getJson("/api/v1/categories?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }

    /**
     * Error Get Category by Identify
     *
     * @return void
     */
    public function testErrorGetCategoryByIdentify()
    {
        $category = 'd9743eaa-57bd-4e76-afca-ca3dbfb25800';

        $tenant = Tenant::factory()->create();

        $response = $this->getJson("/api/v1/categories/{$category}?token_company={$tenant->uuid}");

        $response->assertStatus(404);
    }


    /**
     * Get Category by Identify
     *
     * @return void
     */
    public function testGetCategoryByIdentify()
    {
        $category = Category::factory()->create();

        $tenant = Tenant::factory()->create();

        $response = $this->getJson("/api/v1/categories/{$category->uuid}?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }
}
