<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_successful_login_redirects_to_home(): void
    {
        $user = User::factory()->create();

        $response = $this->withSession(['url.intended' => '/dashboard'])
            ->post(route('login'), [
                'email' => $user->email,
                'password' => 'password',
            ]);

        $response->assertRedirectToRoute('home');
        $this->assertAuthenticatedAs($user);
    }
}
