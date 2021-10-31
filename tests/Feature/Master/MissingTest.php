<?php

namespace Test\Feature\Master;

use Tests\TestCase;
use App\Models\User;
use App\Models\Missing;
use App\Models\Missinglist;

class MissingTest extends TestCase
{

    public function testBlockedMissingPage() : void
    {
        // Etant donné que
        // Je ne suis pas connecté en tant que enseignant
        // quand je vais sur /master/missing
        $response = $this->get('/master/missing');

        // Alors je dois recevoir un 302
        $response->assertStatus(302);
        $response->assertRedirect('/master/login');
    }

    public function testAccessMissingPage() : void
    {
        // Etant donné que
        // Je suis connecté en tant que enseignant
        $master = $this->getMasterInitialData();
        $this->loginAsMaster($master);
        // quand je vais sur /master/missing
        $response = $this->get('/master/missing');
        // Alors je dois recevoir un 200
        $response->assertOk();
    }

    public function testAccessIfMasterHaventClasse() : void
    {
        // Etant donné que
        // Je suis connecté en tant que enseignant qui n'a pas de classe
        $master = User::factory()->create();
        $this->loginAsMaster($master);
        // quand je vais sur /master/missing
        $response = $this->get('/master/missing');
        // Alors je dois recevoir un 302
        $response->assertStatus(302);
        $response->assertSessionHas('danger', 'Vous ne disposez pas de classe pour générer une liste d\'absence');
    }

    public function testGenerateMissingListOfDay() : void 
    {
        // Etant donné que je sui connéte en tant que enseigant
        $master = $this->getMasterInitialData();
        $this->loginAsMaster($master);
        // quand je vais sur /master/missing/create
        $response = $this->get('/master/missing/create');
        // Alors je creer un liste journaler dans la base de données
        $this->assertDatabaseCount('missings', 1);
        $response->assertSessionHas('success');
    }

    public function testGenerateMissingListWillGenerateAllStudentOfThisList() : void 
    {
        // Etant donné que je sui connéte en tant que enseigant
        $master = $this->getMasterInitialData();
        $this->loginAsMaster($master);
        // quand je cree la liste du jour
        $response = $this->get('/master/missing/create');
        $this->assertDatabaseCount('missings', 1);
        $response->assertSessionHas('success');
        // Alors je veux avoir la liste de ma classe
        $studentCount = $master->classe->students->count();
        $this->assertDatabaseCount('missinglists', $studentCount);
    }

    public function testNeverHaveTwoListOnOneDay() : void
    {
        // Etant donné que je sui connéte en tant que enseigant
        $master = $this->getMasterInitialData();
        $this->loginAsMaster($master);
        // quand je vais sur /master/missing/create
        $response1 = $this->get('/master/missing/create');
        $response1->assertSessionHas('success');

        $response2 = $this->get('/master/missing/create');
        $response2->assertSessionHas('danger');
        // Alors je creer un liste journaler dans la base de données
        $this->assertDatabaseCount('missings', 1);
    }

    public function testMarkMissing() : void 
    {
        // Etant donné que j'un list du jour
        $master = $this->getMasterInitialData();
        $this->loginAsMaster($master);
        $this->get('/master/missing/create');

        // Quand je marque un eleve abscent
        /** @var Missing $listDay */
        $listDay = $master->fresh()->classe->missings()->first();
        /** @var Missinglist $studentMark */
        $studentMark = $listDay->missinglists()->first();
        $response = $this->json('POST','/master/missing/mark',[
            'missing_list_item' => $studentMark->id,
        ]);

        // Alors il doit etre marqué en base de données
        $response->assertSuccessful();

        $this->assertDatabaseHas('missinglists', [
            'id' => $studentMark->id,
            'missing' => true,
        ]);
    }

    /** @test */
    public function incrementMissingCount() : void
    {
        // Etant donné que j'un list du jour
        $master = $this->getMasterInitialData();
        $this->loginAsMaster($master);
        $this->get('/master/missing/create');

        // Quand je marque un eleve abscent
        /** @var Missing $listDay */
        $listDay = $master->fresh()->classe->missings()->first();
        /** @var Missinglist $studentMark */
        $studentMark = $listDay->missinglists()->first();
        $response = $this->json('POST','/master/missing/mark',[
            'missing_list_item' => $studentMark->id,
        ]);

        // Alors il doit etre marqué en base de données
        $response->assertSuccessful();
        $this->assertEquals(1, $listDay->fresh()->missing_count);
        $this->assertDatabaseHas('missinglists', [
            'id' => $studentMark->id,
            'missing' => true,
        ]);
    }

    /** @test */
    public function uncrementMissingCount() : void
    {
        // Etant donné que j'un list du jour
        $master = $this->getMasterInitialData();
        $this->loginAsMaster($master);
        $this->get('/master/missing/create');

        // Quand je marque un eleve abscent
        /** @var Missing $listDay */
        $listDay = $master->fresh()->classe->missings()->first();
        /** @var Missinglist $studentMark */
        $studentMark = $listDay->missinglists()->first();
    
        $response = $this->json('POST','/master/missing/mark',[
            'missing_list_item' => $studentMark->id,
        ]);

        $response->assertSuccessful();
        $this->assertEquals(1, $listDay->fresh()->missing_count);

        $response2 = $this->json('POST','/master/missing/mark',[
            'missing_list_item' => $studentMark->id,
        ]);

        // Alors il doit etre marqué en base de données
        $response2->assertSuccessful();
        $this->assertEquals(0, $listDay->fresh()->missing_count);
        $this->assertDatabaseHas('missinglists', [
            'id' => $studentMark->id,
            'missing' => false,
        ]);
    }
}