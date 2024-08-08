<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase; 
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_create_form()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
    
    public function test_login_post_success()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
    
    public function test_login_post_failure()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password-salah',
        ]);

        $response->assertInvalid(['email']); //email salah
        $response->assertFound();   //pengalihan sementara ke halaman login code 302
        $this->assertGuest();
    }
}
