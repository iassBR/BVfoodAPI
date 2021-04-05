<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * Error Get All Tenants.
     *
     * @return void
     */
    public function testErrorGetAllProductsByTenants()
    {
        $token_company = "d9743eaa-57bd-4e76-afca-ca3dbfb25800";

        $response = $this->getJson("/api/v1/products?token_company={$token_company}");

        $response->assertStatus(422);
    }


    /**
     * Get All Tenants.
     *
     * @return void
     */
    public function testGetAllProductsByTenant()
    {
        $token_company = Tenant::factory()->create()->uuid;

        $response = $this->getJson("/api/v1/products?token_company={$token_company}");

        $response->assertStatus(200);
    }

    /**
     * Error Get Product  By Identify.
     *
     * @return void
     */
    public function testNotFoundProduct()
    {
        $token_company = Tenant::factory()->create()->uuid;

        $product = "d9743eaa-57bd-4e76-afca-ca3dbfb25800";

        $response = $this->getJson("/api/v1/products/{$product}?token_company={$token_company}");

        $response->assertStatus(404);
    }

    /**
     * Error Get Product  By Identify.
     *
     * @return void
     */
    public function testGetProductByIdentify()
    {
        $token_company = Tenant::factory()->create()->uuid;

        $product = Product::factory()->create()->uuid;

        $response = $this->getJson("/api/v1/products/{$product}?token_company={$token_company}");

        $response->assertStatus(200);
    }
}
