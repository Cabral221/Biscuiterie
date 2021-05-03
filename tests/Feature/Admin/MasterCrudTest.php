<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\Admin;

class MasterCrudTest extends TestCase {

    /** @test */
    public function page_add_master_is_enabled() : void
    {
        // Etant donnée que je suis connecté en tant que admin
        $this->loginAsAdmin(Admin::factory()->create());

        // Quand
        // J'appelle la page /admin/master/add
        $this->get('/admin/enseignants/create')
        
        // Alors
        // je doit avoir 200 comme code de status
        ->assertStatus(200);
    }

    /** @test */
    public function add_master_record() : void
    {
        // Etant donnée que je suis connecté en tant que admin
        $this->loginAsAdmin(Admin::factory()->create());

        // Quand 
        // je rempli le formaulaire d'ajout d'un eseignant et que je soumet
        $data = [
            'first_name' => 'Abdourahmane',
            'last_name' => 'Diop',
            'kind' => true,
            'email' => 'cabraldiop18@gmail.com',
            'phone' => 778435052,
        ];
        $response = $this->post('/admin/enseignants/create', $data);

        // Alors les information doivent etre stocker dans la base de données
        // dd($response->getContent());
        $response->assertStatus(302);
        $response->assertRedirect('/admin/enseignants');
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('users',[
            'first_name' => 'Abdourahmane',
            'last_name' => 'Diop',
            'kind' => true,
            'email' => 'cabraldiop18@gmail.com',
            'phone' => 778435052,
        ]);
    }
}