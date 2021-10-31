<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Classe;
use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class StudentCountTest extends TestCase 
{
    use WithoutMiddleware;

    /**
    * @test
    * Tester l'increment avec l'ajout d'un etudiant.
    *
    * @return void
    */
    public function increment_when_add_student()
    {
        // Etant donné qu'un admin est connecté
        $this->loginAsAdmin(Admin::factory()->create());

        // Quand il enregistre un eleve
        $master = $this->getMasterInitialData();

        $student = Student::factory()->make(['classe_id' => $master->classe->id]);
        $nbStudent = $student->classe->students->count();
        $response = $this->post("/admin/students", $student->getAttributes());

        // Le compte de la classe doit s'incrémenter
        $classe = $student->classe->refresh();
        $response->assertRedirect("/admin/classes/{$classe->id}");
        $this->assertEquals($nbStudent + 1, $classe->total);
    }
    
    /**
    * @test
    * tester la décrement avec la suppression d'un eleve.
    *
    * @return void
    */
    public function decrement_when_delete_student()
    {
        // Etant donné qu'un admin est connecté
        $this->loginAsAdmin(Admin::factory()->create());

        // Quand il supprime un eleve
        $master = $this->getMasterInitialData();
        /** @var Student     */
        $student = $master->classe->students()->first();
        /** @var Classe */
        $classe = $student->classe;
        $nbStudent = $classe->students->count();
        $this->withoutMiddleware();
        $response = $this->delete("/admin/students/{$student->id}");

        // Le compte de la classe doit décrémenter
        /** @var Classe */
        $classe = $student->classe;
        $classe->refresh();
        $response->assertRedirect("/");
        $this->assertEquals($nbStudent - 1, $classe->total);
    }

    /**
    * @test
    * Tester l'increment du champs nombre de garçon.
    *
    * @return void
    */
    public function increment_boy_count_when_add_student_boy()
    {
        // Etant donné qu'un admin est connecté
        $this->loginAsAdmin(Admin::factory()->create());
        $master = $this->getMasterInitialData();

        // Quand il enregistre un eleve garçon
        $student = Student::factory()->make(['kind' => true, 'classe_id' => $master->classe->id]);
        $nbStudent = $student->classe->students->count();
        $boyCount = $student->classe->boy_count;
        $response = $this->post("/admin/students", $student->getAttributes());

        // Le compte de la classe doit s'incrémenter
        $classe = $student->classe->refresh();
        $response->assertRedirect("/admin/classes/{$classe->id}");
        $this->assertEquals($nbStudent + 1, $classe->total);
        $this->assertEquals($boyCount + 1, $classe->boy_count);
    }

    /**
    * @test
    * Tester la décrementation du champs nombre de garçon.
    *
    * @return void
    */
    public function decrement_boy_count_when_delete_student_boy()
    {
        // Etant donné qu'un admin est connecté
        $this->loginAsAdmin(Admin::factory()->create());

        // Quand il supprime un eleve garçon
        $master = $this->getMasterInitialData();
        $master->classe->students()->save(Student::factory()->make(['kind' => true]));
        /** @var Student */
        $student = Student::where('kind', true)->first();
        /** @var Classe */
        $classe = $student->classe;
        /** @var Collection */
        $students = $classe->students;
        $nbStudent = $students->count();
        $boyCount = $classe->boy_count;
        $this->withoutMiddleware();
        $response = $this->delete("/admin/students/{$student->id}");

        // Le compte de la classe doit décrémenter
        /** @var Classe */
        $classe = $student->classe;
        $classe->refresh();
        $response->assertRedirect("/");
        $this->assertEquals($nbStudent - 1, $classe->total);
        $this->assertEquals($boyCount - 1, $classe->boy_count);
    }

     /**
    * @test
    * Tester l'increment du champs nombre de fille.
    *
    * @return void
    */
    public function increment_girl_count_when_add_student_girl()
    {
        // Etant donné qu'un admin est connecté
        $this->loginAsAdmin(Admin::factory()->create());

        // Quand il enregistre un eleve garçon
        $master = $this->getMasterInitialData();
        $student = Student::factory()->make(['kind' => false, 'classe_id' => $master->classe->id]);
        $nbStudent = $student->classe->students->count();
        $girlCount = $student->classe->girl_count;
        $response = $this->post("/admin/students", $student->getAttributes());

        // Le compte de la classe doit s'incrémenter
        $classe = $student->classe->refresh();
        $response->assertRedirect("/admin/classes/{$classe->id}");
        $this->assertEquals($nbStudent + 1, $classe->total);
        $this->assertEquals($girlCount + 1, $classe->girl_count);
    }

    /**
    * @test
    * Tester la décrementation du champs nombre de fille.
    *
    * @return void
    */
    public function decrement_girl_count_when_delete_student_girl()
    {
        // Etant donné qu'un admin est connecté
        $this->loginAsAdmin(Admin::factory()->create());

        // Quand il supprime un eleve fille
        $master = $this->getMasterInitialData();
        $master->classe->students()->save(Student::factory()->make(['kind' => false]));
        /** @var Student */
        $student = Student::where('kind', false)->first();
        /** @var Classe */
        $classe = $student->classe;
        /** @var Collection */
        $students = $classe->students;
        $nbStudent = $students->count();
        $girlCount = $classe->girl_count;
        $this->withoutMiddleware();
        $response = $this->delete("/admin/students/{$student->id}");

        // Le nombre de fille de la classe doit décrémenter
        /** @var Classe */
        $classe = $student->classe;
        $classe->refresh();
        $response->assertRedirect("/");
        $this->assertEquals($nbStudent - 1, $classe->total);
        $this->assertEquals($girlCount - 1, $classe->girl_count);
    }
}