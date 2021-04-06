<?php

namespace Tests\Feature;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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
}
