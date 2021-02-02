<?php

namespace Tests\Feature\Master;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationMasterTest extends TestCase
{
    /** @test */
    public function the_login_route_exist() : void
    {
        $this->get('/master/login')->assertStatus(200);
    }

    /** @test */
    public function login_requires_validation() : void
    {
        $response = $this->post('master/login');

        $response->assertSessionHasErrors(['email', 'password']);
    }

    /** @test */
    public function a_user_can_login_with_email_and_password() : void
    {
        $user = User::factory()->create([
            'email' => 'john@example.com',
        ]);

        $response = $this->post('master/login', [
            'email' => 'john@example.com',
            'password' => 'password',
        ]);
        $response->assertRedirect("/master");
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function a_user_cannot_login_with_bad_email_and_password(): void
    {
        $user = User::factory()->create([
            'email' => 'john@example.com',
        ]);

        $response = $this->post('master/login', [
            'email' => 'john@example.com',
            'password' => 'badpassword',
        ]);
        $response->assertRedirect("/");
        $response->assertSessionHas('errors');
    }


}
