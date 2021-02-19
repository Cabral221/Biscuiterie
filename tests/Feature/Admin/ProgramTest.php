<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\Program;

class ProgramTest extends TestCase
{
    /** @test */
    public function the_route_program_exist(): void
    {
        $this->get('/admin/programs')->assertStatus(302);
    }

    /** @test */
    public function the_route_need_admin_authentication (): void
    {
        $this->get('/admin/programs')->assertRedirect(route('admin.login'));

        $this->loginAsMaster(User::factory()->create());

        $this->get('/admin/programs')->assertRedirect(route('admin.login'));

        $this->loginAsAdmin(Admin::factory()->create());

        $this->get('/admin/programs')->assertStatus(200);
    }

    /** @test */
    public function it_admin_cannot_add_program_without_validate_data(): void
    {
        $this->loginAsAdmin(Admin::factory()->create());

        $response = $this->from('/')->post('/admin/programs', [
            'libele' => '',
        ])->assertRedirect('/');

        $response->assertSessionHasErrors(['libele']);

        $this->assertDatabaseMissing('programs', [
            'libele' => ''
        ]);
    }

    /** @test */
    public function it_admin_store_program () : void
    {
        $this->loginAsAdmin(Admin::factory()->create());
        $response = $this->post('/admin/programs', [
            'libele' => 'Test-Program',
            'niveaux' => [1, 2]
        ]);
        
        $response->assertSessionHas('success');
        $response->assertRedirect('/admin/programs');
        $this->assertDatabaseHas('programs', [
            'libele' => 'Test-Program',
        ]);
    }

    /** @test */
    public function admin_can_update_program () : void
    {
        $this->loginAsAdmin(Admin::factory()->create());
        /** @var Program */
        $program = Program::find(1);

        $response = $this->patch("/admin/programs/$program->id/update", [
            'libele' => 'Libele-updated',
        ]);
        
        $response->assertStatus(302);
        $response->assertRedirect('/admin/programs');
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('programs', [
            'libele' => 'Libele-updated',
        ]);
    }

    /** @test */
    public function admin_can_delete_program() : void
    {
        $this->loginAsAdmin(Admin::factory()->create());
        /** @var Program */
        $program = Program::find(1);

        $response = $this->delete("/admin/programs/$program->id/destroy");

        $response->assertStatus(302);
        $response->assertRedirect('/admin/programs');
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('programs', [
            'id' => $program->id,
        ]);
    }

    /** @test */
    public function admin_cant_delete_program_if_not_exist(): void
    {
        $this->loginAsAdmin(Admin::factory()->create());

        $response = $this->from('/admin/programs')->delete("/admin/programs/azeaze/destroy");

        $response->assertStatus(500);
    }
}