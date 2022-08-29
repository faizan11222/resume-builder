<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;

class logintest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
  
    public function test_users_can_authenticate_using_the_login_screen()
    {
        $user = User::factory()->create();
 
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
 
      
        $response->assertRedirect('/');
    }
 
    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $user = User::factory()->create();
 
        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);
 
        $this->assertGuest();
    }
}