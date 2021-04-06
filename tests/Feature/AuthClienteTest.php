<?php

namespace Tests\Feature;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class AuthClienteTest extends TestCase
{
    /**
     * Test Validation Auth.
     *
     * @return void
     */
    public function testValidationAuth()
    {
        $response = $this->postJson('/api/auth/token');

        $response->assertStatus(422);
    }

    /**
     * Test Auth With User Fake.
     *
     * @return void
     */
    public function testAuthWithUserFake()
    {
        $payload = [
            'email' => 'yo123@mail.com',
            'password' => '123123123',
            'device_name' => 'powpowpow'
        ];

        $response = $this->postJson('/api/auth/token', $payload);

        $response->assertStatus(404)
            ->assertExactJson([
                'message' => trans('messages.invalid_credentials')
            ]);
    }


    /**
     * Test Auth Success.
     *
     * @return void
     */
    public function testAuthSuccess()
    {
        $client = Client::factory()->create();

        $payload = [
            'email' => $client->email,
            'password' => 'password',
            'device_name' => 'powpowpow'
        ];

        $response = $this->postJson('/api/auth/token', $payload);

        $response->assertStatus(200)->assertJsonStructure(['token']);
    }


    /**
     * Error get me.
     *
     * @return void
     */
    public function testErrorGetMe()
    {

        $response = $this->getJson('/api/auth/me');

        $response->assertStatus(401);
    }


    /**
     * Test Get me.
     *
     * @return void
     */
    public function testGetMe()
    {
        $client = Client::factory()->create();

        $token = $client->createToken(Str::random(10))->plainTextToken;

        $response = $this->getJson('/api/auth/me', [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200)
            ->assertExactJson([
                'data' => [
                    'name' => $client->name,
                    'email' => $client->email
                ]
            ]);
    }


    /**
     * Test Logout.
     *
     * @return void
     */
    public function testLogout()
    {
        $client = Client::factory()->create();

        $token = $client->createToken(Str::random(10))->plainTextToken;

        $response = $this->postJson('/api/auth/logout', [], [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(204);
    }
}
