<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_registered_user_can_log_in(): void
    {

        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $this->assertAuthenticatedAs($user);
    }


    public function test_unregistered_user_cant_log_in(): void 
    {
        $response = $this->post('/login', [
            'email' => 'fulanito@ejemplo.es',
            'password' => 'password'
        ]);

        $this->assertGuest();
    }

    
}
