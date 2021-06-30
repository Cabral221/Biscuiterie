<?php

use App\Models\User;
use Tests\TestCase;

class MissingTest extends TestCase
{
    public function testBlockedMissingPage() {
        // Etant donné que
        // Je ne suis pas connecté en tant que enseignant
        // quand je vais sur /master/missing
        $response = $this->get('/master/missing');

        // Alors je dois recevoir un 302
        $response->assertStatus(302);
        $response->assertRedirect('/master/login');
    }

    public function testAccessMissingPage() {
        // Etant donné que
        // Je suis connecté en tant que enseignant
        $this->loginAsMaster(User::factory()->create());
        // quand je vais sur /master/missing
        $response = $this->get('/master/missing');
        // Alors je dois recevoir un 200
        $response->assertOk();
    }

    public function testGenerateMissingListOfDay() {
        // Etant donné que je sui connéte en tant que enseigant
        $this->loginAsMaster(User::first());
        // quand je vais sur /master/missing/create
        $response = $this->get('/master/missing/create');
        // Alors je creer un liste journaler dans la base de données
        $this->assertDatabaseCount('missings', 1);
        $response->assertSessionHas('success');
    }

    public function testGenerateMissingListWillGenerateAllStudentOfThisList() {
        // Etant donné que je sui connéte en tant que enseigant
        $user = User::first();
        $this->loginAsMaster($user);
        // quand je cree la liste du jour
        $response = $this->get('/master/missing/create');
        $this->assertDatabaseCount('missings', 1);
        $response->assertSessionHas('success');
        // Alors je veux avoir la liste de ma classe
        $studentCount = $user->classe->students->count();
        $this->assertDatabaseCount('missinglists', $studentCount);
    }

    public function testNeverHaveTwoListOnOneDay() : void
    {
        // Etant donné que je sui connéte en tant que enseigant
        $this->loginAsMaster(User::first());
        // quand je vais sur /master/missing/create
        $response1 = $this->get('/master/missing/create');
        $response1->assertSessionHas('success');

        $response2 = $this->get('/master/missing/create');
        $response2->assertSessionHas('danger');
        // Alors je creer un liste journaler dans la base de données
        $this->assertDatabaseCount('missings', 1);
    }


}