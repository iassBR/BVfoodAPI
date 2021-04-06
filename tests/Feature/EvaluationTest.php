<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class EvaluationTest extends TestCase
{
    /**
     * Test Error Store Evaluation.
     *
     * @return void
     */
    public function testErrorStoreEvaluation()
    {
        $order = Str::random(10);

        $response = $this->postJson("api/auth/v1/orders/{$order}/evaluations");

        $response->assertStatus(401);
    }


    /**
     * Test Store Evaluation.
     *
     * @return void
     */
    public function testStoreEvaluation()
    {
        $client = Client::factory()->create();

        $token = $client->createToken(Str::random(10))->plainTextToken;

        $order = $client->orders()->save(Order::factory()->create());

        $payload = [
            'stars' => 4,
            'comment' => 'Bom pra carai'
        ];

        $headers = [
            'Authorization' => "Bearer {$token}"
        ];

        $response = $this->postJson("api/auth/v1/orders/{$order->identify}/evaluations", $payload, $headers);

        $response->assertStatus(201);
    }
}
