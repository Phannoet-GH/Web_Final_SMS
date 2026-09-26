<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Login Form');
        $response->assertSee('adminwoman@gmail.com');
    }

    public function test_register_page_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Register Form');
        $response->assertSee('please input your name');
    }

    public function test_user_can_login_with_valid_credentials(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'adminwoman@gmail.com'],
            [
                'name' => 'Admin Woman',
                'password' => Hash::make('password'),
            ]
        );

        $response = $this->post('/login', [
            'email' => 'adminwoman@gmail.com',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('students.index'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_login_with_invalid_password(): void
    {
        $response = $this->post('/login', [
            'email' => 'adminwoman@gmail.com',
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_new_user_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'New Student Officer',
            'email' => 'officer@example.com',
            'password' => 'secret123',
        ]);

        $response->assertRedirect(route('students.index'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'officer@example.com']);
    }

    public function test_user_can_logout(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect(route('login'));
        $this->assertGuest();
    }
}
