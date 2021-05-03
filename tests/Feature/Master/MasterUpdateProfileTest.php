<?php
namespace Tests\Feature\Master;

use Tests\TestCase;
use App\Models\User;

class MasterUpdateProfileTest extends TestCase
{

    /** @test */
    public function profile_update_requires_validation() : void
    {
        $this->loginAsMaster(User::factory()->create());

        $response = $this->put('master/profile/update');

        $response->assertSessionHasErrors(['first_name', 'last_name', 'kind', 'email', 'phone']);
    }

    /** @test */
    public function a_user_can_update_their_profile() : void
    {
        $user = User::factory()->create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane@doe.com',
            'phone' => 709999999,
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'first_name' => 'Jane',
            'last_name' => 'Doe',
        ]);

        $response = $this->actingAs($user)
            ->put('master/profile/update', [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'kind' => true,
                'email' => 'jane@doe.com',
                'phone' => 709999999,
            ])->assertRedirect('/master/profile');

        $response->assertSessionHas('success', __('Profile successfully updated.'));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'kind' => true,
        ]);
    }
    
}