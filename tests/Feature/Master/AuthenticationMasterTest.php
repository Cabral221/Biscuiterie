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
        $response = $this->get('/master/login');

        $response->assertStatus(200);
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
            'password' => 'secret',
        ]);

        $response = $this->post('master/login', [
            'email' => 'john@example.com',
            'password' => 'secret',
        ]);
        $response->assertRedirect("/master");
        $this->assertAuthenticatedAs($user);
    }


}
