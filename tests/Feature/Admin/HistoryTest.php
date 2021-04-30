<?php

namespace Tests\Feature\Admin;

use App\Models\History_user;
use Tests\TestCase;
use App\Models\User;

class HistoryTest extends TestCase 
{

    /** @test */
    public function add_master_to_history_on_create() : void
    {
        // Étant données que l'enseignant est ajoutée
        User::factory()->create(['email' => 'test@history.com']);

        // L'enseignant doit etre enregistrer dans la table historique
        $this->assertDatabaseHas('users', ['email' => 'test@history.com']);
        $this->assertDatabaseHas('history_users', ['email' => 'test@history.com']);
    }

    /** @test */
    public function sync_history_data_on_update_source() : void
    {
        // Etant donnée qu'on crée un enseignant
        $master = User::factory()->create(['email' => 'test@history.com']);
        
        // Quand on modifie les données de l'enseignant
        $master->update([
            'email' => 'testedit@history.com',
            'phone' => 778435052,
        ]);

        // On doit sync les donnees dans l'historique
        // avec le dernier sauvegarde valide sur l'année scolaire
        $h_master = History_user::where('original_id', $master->id)->latest()->first();
        // dd($h_master->getAttributes());
        $this->assertEquals('testedit@history.com', $h_master->email);
        

    }

}