<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\Classe;

class MissingTest extends TestCase
{
    public function getClasse() : Classe 
    {
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

    public function testMarkMissing() {
        // Etant donné que j'un list du jour
        $master = User::first();
            $this->loginAsMaster($master);
            $this->get('/master/missing/create');
            // Quand je marque un eleve abscent
            $ListDay = $master->fresh()->classe->missings()->first();
            $studentMark = $ListDay->missinglists()->first();
            $response = $this->json('POST','/master/missing/mark',[
                'missing_list_item' => $studentMark->id,
            ]);
            // Alors il doit etre marqué en base de données
            // dd($response->getContent());
            $response->assertSuccessful();

            $this->assertDatabaseHas('missinglists', [
                'id' => $studentMark->id,
                'missing' => true,
            ]);

        // Quand je mark un eleve en tant que admin
        $this->loginAsAdmin(Admin::first());
        $classe = $master->fresh()->classe;
        $missingStudentItem = $ListDay->fresh()->missinglists()->first();
        $response = $this->json('POST', "/admin/classes/$classe->id/missing/mark", [
            'missing_list_item' => $missingStudentItem->id,
        ]);

        $response->assertSuccessful();
        $this->assertDatabaseHas('missinglists', [
            'id' => $missingStudentItem->id,
            'missing' => false,
        ]);
    }

}