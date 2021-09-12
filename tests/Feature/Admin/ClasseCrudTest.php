<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use App\Models\Classe;
use App\Models\Niveau;
use App\Models\Program;
use App\Models\User;
use Tests\TestCase;

class ClasseCrudTest extends TestCase 
{
    // Tester que l'admin puis creer une classe
    /** @test */
    public function admin_can_store_classe_with_correct_data() : void
    {
        // Etant donnee que je suis connecter en tant que admin
        $this->loginAsAdmin(Admin::factory()->create());
        $niveau = Niveau::factory()->create();
        $user = User::factory()->create();

        // Quand je soumet le formulaire d'ajout de classe
        $response = $this->post("/admin/programs/classes", [
            'libele' => 'N0',
            'niveau_id' => $niveau->id,
            'user_id' => $user->id,
        ]);

        // Alors ca doit se figurer dans la base de donné
        $response->assertSuccessful();
        $this->assertDatabaseHas('classes', [
            'libele' => 'N0',
            'niveau_id' => $niveau->id,
            'user_id' => $user->id,
        ]);
    }

    // Tester que l'admin puis creer une classe
    /** @test */
    public function admin_cant_store_classe_if_user_have_already_classe() : void
    {
        // Etant donnee que je suis connecter en tant que admin
        $this->loginAsAdmin(Admin::factory()->create());
        $niveau = Niveau::factory()->create();
        $user = User::factory()->create();
        Classe::factory()->create(['niveau_id' => $niveau->id, 'user_id' => $user->id]);

        // Quand je soumet le formulaire d'ajout de classe avec un enseignant qui a déjà une classe
        $response = $this->post("/admin/programs/classes", [
            'libele' => 'N0',
            'niveau_id' => $niveau->id,
            'user_id' => $user->id,
        ]);

        // Alors ca ne doit pas figurer dans la base de donné
        $response->assertStatus(400);
        $this->assertDatabaseMissing('classes', [
            'libele' => 'N0',
            'niveau_id' => $niveau->id,
            'user_id' => $user->id,
        ]);
    }

    // Tester que l'admin puis modifier une classe

}
