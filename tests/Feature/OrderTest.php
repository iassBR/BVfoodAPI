<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class OrderTest extends TestCase
{
    /**
     *  Test Validation Store Order.
     *
     * @return void
     */
    public function testValidationStoreOrder()
    {
        $payload = [];

        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(422)
            ->assertJsonPath('errors.token_company', [
                trans('validation.required', ['attribute' => 'token company'])
            ])
            ->assertJsonPath('errors.products', [
                trans('validation.required', ['attribute' => 'products'])
            ]);
    }


    /**
     *  Test Store Order.
     *
     * @return void
     */
    public function testStoreOrder()
    {
        $tenant = Tenant::factory()->create();

        $products = Product::factory(4)->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'products' => []
        ];

        foreach ($products as $product) {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qty' => 2
            ]);
        }


        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(201);
    }


    /**
     *  Test Total Value Order.
     *
     * @return void
     */
    public function testTotalValueOrder()
    {
        $tenant = Tenant::factory()->create();

        $products = Product::factory(2)->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'products' => []
        ];

        foreach ($products as $product) {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qty' => 2
            ]);
        }


        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(201)
            ->assertJsonPath('data.total', 40);
    }

    /**
     *  Test Error Order Not Found.
     *
     * @return void
     */
    public function testErrorOrderNotFound()
    {
        $order = "d9743eaa-57bd-4e76-afca-ca3dbfb25800";

        $response = $this->getJson("/api/v1/orders/{$order}");

        $response->assertStatus(404);
    }


    /**
     *  Test Get Order .
     *
     * @return void
     */
    public function testGetOrder()
    {
        $order = Order::factory()->create();

        $response = $this->getJson("/api/v1/orders/{$order->identify}");

        $response->assertStatus(200);
    }

    /**
     *  Test Total Value Order Authenticated.
     *
     * @return void
     */
    public function testTotalValueOrderAuthenticated()
    {

        $client = Client::factory()->create();

        $token = $client->createToken(Str::random(10))->plainTextToken;

        $tenant = Tenant::factory()->create();

        $products = Product::factory(2)->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'products' => []
        ];

        foreach ($products as $product) {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qty' => 2
            ]);
        }


        $response = $this->postJson('/api/auth/v1/orders', $payload, [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->dump();

        $response->assertStatus(201)
            ->assertJsonPath('data.total', 40);
    }


    /**
     *  Test Store Order With Table.
     *
     * @return void
     */
    public function testStoreOrderWithTable()
    {

        $table = Table::factory()->create();

        $tenant = Tenant::factory()->create();

        $products = Product::factory(2)->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'products' => [],
            'table' => $table->uuid
        ];

        foreach ($products as $product) {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qty' => 2
            ]);
        }


        $response = $this->postJson('/api/v1/orders', $payload);

        $response->dump();

        $response->assertStatus(201);
    }


    /**
     *  Test Get My Orders Authenticated.
     *
     * @return void
     */
    public function testGetMyOrdersAuthenticated()
    {

        $client = Client::factory()->create();

        $token = $client->createToken(Str::random(10))->plainTextToken;

        Order::factory(5)->create(['client_id' => $client->id]);

        $response = $this->getJson('/api/auth/v1/my-orders', [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data');
    }
}
