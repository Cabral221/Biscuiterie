<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use App\Models\Program;
use Tests\TestCase;

class NiveauxCrudTest extends TestCase 
{
    // Tester que l'admin puis creer un niveau
    /** @test */
    public function admin_can_store_niveau_with_correct_data() : void
    {
        // Etant donnee que jesuis connecter en tant que admin
        $this->loginAsAdmin(Admin::factory()->create());
        $program = Program::factory()->create();

        // Quand je soumet le formulaire d'ajout de niveau
        $response = $this->post("/admin/programs/niveaux", [
            'libele' => 'N0',
            'program_id' => $program->id,
        ]);

        // Alors ca doit se figurer dans la base de donné
        $response->assertSuccessful();
        $this->assertDatabaseHas('niveaux', [
            'libele' => 'N0',
            'program_id' => $program->id,
        ]);
    }

}
