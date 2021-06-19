<?php

namespace Tests\Feature\Master;

use Tests\TestCase;
use App\Models\User;

class MasterProfileTest extends TestCase
{
    /** @test */
    public function route_profile_exist() : void
    {
        $response = $this->get('/master/profile');
        $response->assertStatus(302);
    }

    /** @test */
    public function only_authenticated_users_can_access_their_account() : void
    {
        $this->get('/master/profile')->assertRedirect('/master/login');

        $this->actingAs(User::factory()->create());

        $this->get('/master/profile')->assertOk();
    }

    // test "put" data for update profile 
}