<?php

namespace Tests\Unit\Master;

use Tests\TestCase;
use App\Models\Note;
use App\Models\User;

class NoteTest extends TestCase
{
    /** @test */
    public function test_post_note() : void
    {
        // Etant donne que l'utilisateur est connecte
        /** @var User */
        $user = User::first();
        $this->loginAsMaster($user);

        // si on soumet le formulaire
        /** @var Note */
        $note = Note::first();
        $response = $this->patch("/master/notes/{$note->id}/store", [
            'position' => 1,
            'note' => 3,
        ]);

        // alors il doit etre enregistrer en base de donnée
        $response->assertStatus(200);
        $this->assertDatabaseHas('notes', [
            'id' => $note->id,
            'note1' => 3,
        ]);
    }
}
