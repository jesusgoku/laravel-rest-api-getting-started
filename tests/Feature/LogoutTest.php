<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class LogoutTest extends TestCase
{
    public function testUserIsLoggedOutProperly()
    {
        $user = factory(User::class)->create([ 'email' => 'user@test.com' ]);
        $token = $user->generateToken();
        $headers = [ 'Authorization' => "Bearer $token" ];

        $this
            ->json('GET', '/api/todos', [], $headers)
            ->assertStatus(200)
        ;

        $this
            ->json('POST', '/api/logout', [], $headers)
            ->assertStatus(200)
        ;

        $user = User::find($user->id);

        $this->assertEquals(null, $user->api_token);
    }

    public function testUserWithNullToken()
    {
        $user = factory(User::class)->create([ 'email' => 'user@test.com' ]);
        $token = $user->generateToken();
        $headers = [ 'Authorization' => "Bearer $token" ];

        $user->api_token = null;
        $user->save();

        $this
            ->json('GET', '/api/todos', [], $headers)
            ->assertStatus(401)
        ;
    }
}
