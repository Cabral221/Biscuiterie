<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use App\Models\Classe;
use App\Models\Student;
use App\Models\User;
use Tests\TestCase;

class PrintTest extends TestCase
{
    
    // Test qu'une version imprimable est possible avec une classe
    /** @test */
    public function can_get_imprimable_version_for_class_room() : void
    {
        // Etant donnée que 
        // je suis connecter en tant que admin
        // Et que il y'a une classe dans la basse de donnés
        $this->loginAsAdmin(Admin::factory()->create());
        $user = User::factory()->create();
        $classe = Classe::factory()->create(['user_id' => $user->id]);
        Student::factory()->count(10)->create(['classe_id' => $classe->id]);
        
        // Quand je demande la version imprimable avec un id incorrect
        $response = $this->get("/admin/print/classe/" . $classe->id);
        // Alors
        // Ca doit etre disponible

        // dd($response->getContent());
        $response->assertSuccessful();
    }

    /** @test */
    public function get_error_when_classe_is_not_find() : void
    {
        // Etant donnée que 
        // je suis connecter en tant que admin
        // Et que il y'a une classe dans la basse de donnés
        $this->loginAsAdmin(Admin::factory()->create());
        $user = User::factory()->create();
        $classe = Classe::factory()->create(['user_id' => $user->id]);
        Student::factory()->count(10)->create(['classe_id' => $classe->id]);
        
        // Quand je demande la version imprimable
        $response = $this->get("/admin/print/classe/" . 100000);
        // Alors
        // Ca doit etre indisponible
        // dd($response->getContent());
        $response->assertStatus(404);
    }

    /** @test */
    public function get_error_when_classe_id_is_not_integer() : void
    {
        // Etant donnée que 
        // je suis connecter en tant que admin
        // Et que il y'a une classe dans la basse de donnés
        $this->loginAsAdmin(Admin::factory()->create());
        $user = User::factory()->create();
        $classe = Classe::factory()->create(['user_id' => $user->id]);
        Student::factory()->count(10)->create(['classe_id' => $classe->id]);
        
        // Quand je demande la version imprimable
        $response = $this->get("/admin/print/classe/" . 'azeazeaze');
        // Alors
        // Ca doit etre indisponible
        // dd($response->getContent());
        $response->assertStatus(404);
    }

}
