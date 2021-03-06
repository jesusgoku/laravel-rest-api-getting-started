<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    public function testRegisterSuccessfully()
    {
        $payload = [
            'name' => 'testing',
            'email' => 'testing@gmail.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ];

        $this
            ->json('POST', '/api/register', $payload)
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                    'api_token',
                ],
            ])
        ;
    }

    public function testRequiresPasswordEmailAndName()
    {
        $this
            ->json('POST', '/api/register')
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'name' => ['The name field is required.'],
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ],
            ])
        ;
    }

    public function testRequirePasswordConfirmation()
    {
        $payload = [
            'name' => 'testing',
            'email' => 'testing@gmail.com',
            'password' => '12345678',
        ];

        $this
            ->json('POST', '/api/register', $payload)
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'password' => ['The password confirmation does not match.'],
                ],
            ])
        ;
    }
}
