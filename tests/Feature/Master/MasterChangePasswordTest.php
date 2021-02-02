<?php

namespace Tests\Feature\Master;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MasterChangePasswordTest extends TestCase
{
    /** @test */
    public function change_password_requires_validation() : void
    {
        $this->loginAsMaster(User::factory()->create());

        $response = $this->put('master/profile/password');

        $response->assertSessionHasErrors(['current_password', 'password']);
    }

    /** @test */
    public function a_user_can_change_their_password() : void
    {
        $user = User::factory()->create();
        $this->loginAsMaster($user);
        $response = $this->put('master/profile/password', [
                'current_password' => 'password',
                'password' => 'OC4Nzu270N!QBVi%U%qX',
                'password_confirmation' => 'OC4Nzu270N!QBVi%U%qX',
            ]);

        $response->assertRedirect(route('master.profile'));
        $response->assertSessionHas('success', __('Password successfully updated.'));
        $this->assertTrue(Hash::check('OC4Nzu270N!QBVi%U%qX', $user->fresh()->password));
    }
}