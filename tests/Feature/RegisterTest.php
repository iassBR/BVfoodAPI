<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * Error Register Client.
     *
     * @return void
     */
    public function testErrorRegisterClient()
    {
        $payload = [
            "email" => "igor.silva@mail.com",
            "name" => "Igor Silva",
            // "password" => "password",
        ];

        $response = $this->postJson('/api/auth/register', $payload);

        $response->assertStatus(422);
        // ->assertExactJson([
        //     'message' =>  "The given data was invalid.",
        //     'errors' => [
        //         'password' => [trans('validation.required', ['attribute' => 'password'])],
        //     ]
        // ]);
    }


    /**
     * Register Client.
     *
     * @return void
     */
    public function testRegisterClient()
    {
        $payload = [
            "email" => "igor.silva@mail.com",
            "name" => "Igor Silva",
            "password" => "password",
        ];

        $response = $this->postJson('/api/auth/register', $payload);

        $response->assertStatus(201)
        ->assertExactJson([
           'data' => [
               'name' => $payload['name'],
               'email' => $payload['email']
           ]
        ]);
      
    }
}
