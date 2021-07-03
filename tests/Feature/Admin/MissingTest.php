<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use App\Models\Classe;
use Tests\TestCase;

class MissingTest extends TestCase
{
    public function getClasse() {
        return Classe::orderBy('created_at', 'DESC')->first();
    }

    public function testBlockedMissingPageIfNotAuthenticated() {
        // Etant donné que
        // Je ne suis pas connecté en tant que Admin
        // quand je vais sur /admin/classes/{id}/missing
        $classe = $this->getClasse();
        $response = $this->get("/admin/classes/$classe->id/missing");

        // Alors je dois recevoir un 302
        $response->assertStatus(302);
        $response->assertRedirect('/admin/login');
    }

    public function testAccessMissingPageIfAuthenticated() {
        // Etant donné que
        // Je suis connecté en tant que admin
        $classe = $this->getClasse();
        $this->loginAsAdmin(Admin::first());
        // quand je vais sur /admin/classes/{id}/missing
        $response = $this->get("/admin/classes/$classe->id/missing");
        // Alors je dois recevoir un 200
        $response->assertOk();
    }

    // public function testGenerateMissingListOfDay() {
    //     // Etant donné que je sui connéte en tant que enseigant
    //     $this->loginAsAdmin(User::first());
    //     // quand je vais sur /master/missing/create
    //     $response = $this->get('/master/missing/create');
    //     // Alors je creer un liste journaler dans la base de données
    //     $this->assertDatabaseCount('missings', 1);
    //     $response->assertSessionHas('success');
    // }

    // public function testGenerateMissingListWillGenerateAllStudentOfThisList() {
    //     // Etant donné que je sui connéte en tant que enseigant
    //     $user = User::first();
    //     $this->loginAsAdmin($user);
    //     // quand je cree la liste du jour
    //     $response = $this->get('/master/missing/create');
    //     $this->assertDatabaseCount('missings', 1);
    //     $response->assertSessionHas('success');
    //     // Alors je veux avoir la liste de ma classe
    //     $studentCount = $user->classe->students->count();
    //     $this->assertDatabaseCount('missinglists', $studentCount);
    // }

    // public function testNeverHaveTwoListOnOneDay() : void
    // {
    //     // Etant donné que je sui connéte en tant que enseigant
    //     $this->loginAsAdmin(User::first());
    //     // quand je vais sur /master/missing/create
    //     $response1 = $this->get('/master/missing/create');
    //     $response1->assertSessionHas('success');

    //     $response2 = $this->get('/master/missing/create');
    //     $response2->assertSessionHas('danger');
    //     // Alors je creer un liste journaler dans la base de données
    //     $this->assertDatabaseCount('missings', 1);
    // }

    // public function testMarkMissing() {
    //     // Etant donné que j'un list du jour
    //     $master = User::first();
    //     $this->loginAsAdmin($master);
    //     $this->get('/master/missing/create');

    //     // Quand je marque un eleve abscent
    //     $ListDay = $master->fresh()->classe->missings()->first();
    //     $studentMark = $ListDay->missinglists()->first();
    //     $response = $this->json('POST','/master/missing/mark',[
    //         'missing_list_item' => $studentMark->id,
    //     ]);

    //     // Alors il doit etre marqué en base de données
    //     // dd($response->getContent());
    //     $response->assertSuccessful();

    //     $this->assertDatabaseHas('missinglists', [
    //         'id' => $studentMark->id,
    //         'missing' => true,
    //     ]);
    // }

}