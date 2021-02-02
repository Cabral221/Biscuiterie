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

        $response->assertSessionHasErrors(['full_name', 'email', 'phone']);
    }

    /** @test */
    public function a_user_can_update_their_profile() : void
    {
        $user = User::factory()->create([
            'full_name' => 'Jane Doe',
            'email' => 'jane@doe.com',
            'phone' => 709999999,
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'full_name' => 'Jane Doe',
        ]);

        $response = $this->actingAs($user)
            ->put('master/profile/update', [
                'full_name' => 'John Doe',
                'email' => 'jane@doe.com',
                'phone' => 709999999,
            ])->assertRedirect('/master/profile');

        $response->assertSessionHas('success', __('Profile successfully updated.'));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'full_name' => 'John Doe',
        ]);
    }
    
}