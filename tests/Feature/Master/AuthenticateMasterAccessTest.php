<?php

namespace Test\Feature\Master;

use App\Models\Classe;
use Tests\TestCase;
use App\Models\User;

class AuthenticateMasterAccessTest extends TestCase
{
    
    /**
     * @test
     * Tester qu'un enseignant actif peut se connecter
     *
     * @return void
     */
    public function a_active_master_can_authenticated() : void
    {
        // Etent donnée que je suis un enseignant active dans la base de donnée
        $user = User::factory()->create();
        Classe::factory()->create(['user_id' => $user->id]);

        // Quand je me connecte avec mes identifiants
        $response = $this->post('/master/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        // Alors je m'attend a etre authentifier
        $this->assertAuthenticated('web');
        $this->assertAuthenticatedAs($user, 'web');

    }

    /**
     * @test
     * Tester qu'un enseignant qui n'a pas de classe ne peut pas se connecter
     *
     * @return void
     */
    public function a_inactive_cant_authenticated() : void
    {
        // Etant donnée que
        $user = User::factory()->create(['email' => 'test@auth.com']);
        
        // Quand
        $response = $this->post('/master/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        // Alors
        $response->assertStatus(302);
        $this->assertGuest('web');
        $response->assertSessionHasErrors('email', 'Vous ne disposez pas de classe pour vous connecter !');
    }
}