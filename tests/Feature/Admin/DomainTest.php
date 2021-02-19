<?php
namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\Domain;
use App\Models\Program;

class DomainTest extends TestCase
{
    /** @test */
    public function the_route_domaine_exist() : void
    {
        $this->get('/admin/domains')->assertStatus(302);
    }

    /** @test */
    public function the_route_need_admin_authentication(): void
    {
        $this->get('/admin/domains')->assertRedirect(route('admin.login'));

        $this->loginAsMaster(User::factory()->create());

        $this->get('/admin/domains')->assertRedirect(route('admin.login'));

        $this->loginAsAdmin(Admin::factory()->create());

        $this->get('/admin/domains')->assertStatus(200);
    }

    /** @test */
    public function it_admin_cannot_add_domain_without_validate_data(): void
    {
        $this->loginAsAdmin(Admin::factory()->create());

        $response = $this->from('/')->post('/admin/domains', [
            'libele' => '',
        ])->assertRedirect('/');

        $response->assertSessionHasErrors('libele');

        $this->assertDatabaseMissing('domains', [
            'libele' => ''
        ]);
    }

    /** @test */
    public function it_store_with_validate_data() : void
    {
        $this->loginAsAdmin(Admin::factory()->create());
        $program = Program::factory()->create();

        $response = $this->post('/admin/domains', [
            'program' => $program->id,
            'libele' => 'Domain',
        ]);

        $response->assertRedirect('/admin/domains');
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('domains', [
            'libele' => 'Domain',
            'program_id' => $program->id,
        ]);
    }

    /** @test */
    public function admin_can_update_domain() : void
    {
        $this->loginAsAdmin(Admin::factory()->create());
        $program = Program::factory()->create();

        $this->post('/admin/domains', [
            'program' => $program->id,
            'libele' => 'Domain',
        ])->assertRedirect('/admin/domains')
          ->assertSessionHas('success');
        $domain = Domain::factory()->create(['program_id' => $program->id]);

        $response = $this->patch("/admin/domains/$domain->id/update", [
            'libele' => 'Domain-updated',
            'program' => $program->id
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/domains');
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('domains', [
            'libele' => 'Domain-updated',
        ]);
    }

    /** @test */
    public function admin_can_delete_domain() : void 
    {
        $this->loginAsAdmin(Admin::factory()->create());
        $program = Program::factory()->create();
        $domain = Domain::factory()->create(['program_id' => $program->id]);

        $this->assertCount(1, $program->domains);

        $response = $this->delete("/admin/domains/$domain->id/destroy");

        $response->assertStatus(302);
        $response->assertRedirect('/admin/domains');
        $response->assertSessionHas('success');
        $this->assertCount(0, $program->fresh()->domains);
        $this->assertDatabaseMissing('domains', [
            'id' => $domain->id,
        ]);
    }
}