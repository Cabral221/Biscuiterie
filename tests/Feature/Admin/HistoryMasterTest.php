<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\Classe;
use App\Models\History_user;
use Carbon\Carbon;

class HistoryMasterTest extends TestCase 
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
        $count_history = History_user::count();
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
        $this->assertEquals($count_history, History_user::count());
    }

    // Tester l'attribution des period (annee scolaire)
    /** @test */
    public function attribute_right_period_with_first_three_month() : void
    {
        // Etant donner que je suis connecter en tant que admin
        $user = User::factory()->create([
            'created_at' => Carbon::createFromDate(Carbon::now()->year, 10, 1),
        ]);

        $this->assertDatabaseHas('history_users', [
            'original_id' => $user->id,
            'period' => Carbon::now()->year . '-' . (Carbon::now()->year + 1)
        ]);
    }

    /** @test */
    public function attribute_right_period() : void
    {
        // Etant donner que je suis connecter en tant que admin
        $user = User::factory()->create([
            'created_at' => Carbon::createFromDate(Carbon::now()->year, 1, 1),
        ]);

        $this->assertDatabaseHas('history_users', [
            'original_id' => $user->id,
            'period' => (Carbon::now()->year - 1) . '-' . Carbon::now()->year
        ]);
    }

    /** @test */
    public function get_data_from_api_for_period() : void
    {
        // Etant donner que je suis connecter en tant que admin
        // Et que 
        $this->loginAsAdmin(Admin::first());

        $users = User::factory()->count(5)->create([
            'created_at' => Carbon::createFromDate(Carbon::now()->year - 2, 10, 1),
        ]);
        foreach ($users as $user) {
            Classe::factory()->make(['user_id' => $user->id]);
        }

        // Quand je demande l'historique en lui donnant une année
        $response = $this->post("/admin/histories/", [ 'year' =>  Carbon::now()->year - 1]);
        
        // Alors je dois recevoir le'ensemble des enregistrement de cette periode
        $response->assertSuccessful();
        $this->assertEquals(5, count(json_decode($response->getContent())));
    }

    // /** @test */
    public function get_error_from_api_for_invalid_period() : void
    {
        // Etant donner que je suis connecter en tant que admin
        $this->loginAsAdmin(Admin::first());

        $users = User::factory()->count(5)->create([
            'created_at' => Carbon::createFromDate(Carbon::now()->year - 1, 9, 1),
        ]);
        foreach ($users as $user) {
            Classe::factory()->make(['user_id' => $user->id]);
        }

        $response = $this->post("/admin/histories/", [ 'year' =>  Carbon::now()->year - 1]);
        
        $response->assertSuccessful();
        $this->assertEquals(0, count(json_decode($response->getContent())));
    }

    /** @test */
    public function get_exception_where_histories_is_empty() : void
    {
        // Etant donner que je suis connecter en tant que admin
        $this->loginAsAdmin(Admin::first());

        // Quand
        $response = $this->post("/admin/histories/", [ 'year' =>  Carbon::now()->year - 1]);
        
        // Alors
        $response->assertStatus(404);
    }

    // On ne peut pas demander l'historique de l'annee en cours
    // /** @test */
    // public function cannot_get_histories_for_current_year() : void
    // {
    //     // Etant donner que je suis connecter en tant que admin
    //     $this->loginAsAdmin(Admin::first());

    //     $users = User::factory()->count(5)->create([
    //         'created_at' => Carbon::createFromDate(Carbon::now()->year - 1, 10, 1),
    //     ]);
    //     foreach ($users as $user) {
    //         Classe::factory()->make(['user_id' => $user->id]);
    //     }

    //     // Quand
    //     $response = $this->post("/admin/histories/", [ 'year' =>  Carbon::now()->year]);
        
    //     // Alors
    //     $response->assertStatus(400);
    // }

}
