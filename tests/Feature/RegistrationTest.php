<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_registration_form(): void
    {
        $response = $this->get(route('register'));

        $response->assertOk();
        $response->assertViewIs('auth.register');
    }

    public function test_valid_registration_creates_user_and_authenticates_them(): void
    {
        $response = $this->post(route('register'), [
            'name' => 'Petani VILAGRO',
            'email' => 'petani@example.com',
            'password' => 'StrongPass123!',
            'password_confirmation' => 'StrongPass123!',
        ]);

        $response->assertRedirectToRoute('home');
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('users', [
            'name' => 'Petani VILAGRO',
            'email' => 'petani@example.com',
        ]);
        $this->assertDatabaseMissing('users', [
            'email' => 'petani@example.com',
            'password' => 'StrongPass123!',
        ]);
        $this->assertAuthenticatedAs(User::where('email', 'petani@example.com')->firstOrFail());
    }

    public function test_registration_requires_name_email_and_password(): void
    {
        $response = $this->post(route('register'), []);

        $response->assertRedirectBackWithErrors(['name', 'email', 'password']);
        $this->assertGuest();
        $this->assertDatabaseCount('users', 0);
    }

    public function test_registration_rejects_an_email_that_is_already_in_use(): void
    {
        User::factory()->create(['email' => 'petani@example.com']);

        $response = $this->post(route('register'), [
            'name' => 'Petani Baru',
            'email' => 'petani@example.com',
            'password' => 'StrongPass123!',
            'password_confirmation' => 'StrongPass123!',
        ]);

        $response->assertRedirectBackWithErrors(['email']);
        $this->assertGuest();
        $this->assertDatabaseCount('users', 1);
    }

    public function test_registration_rejects_a_password_confirmation_mismatch(): void
    {
        $response = $this->post(route('register'), [
            'name' => 'Petani VILAGRO',
            'email' => 'petani@example.com',
            'password' => 'StrongPass123!',
            'password_confirmation' => 'DifferentPass123!',
        ]);

        $response->assertRedirectBackWithErrors(['password']);
        $this->assertGuest();
        $this->assertDatabaseCount('users', 0);
    }
}
