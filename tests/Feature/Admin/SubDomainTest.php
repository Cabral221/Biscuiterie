<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\Domain;
use App\Models\Program;

class SubDomainTest extends TestCase
{
    /** @test */
    public function the_route_need_admin_authentication(): void
    {
        $this->post('/admin/subdomains')->assertRedirect(route('admin.login'));

        $this->loginAsMaster(User::factory()->create());

        $this->post('/admin/subdomains')->assertRedirect(route('admin.login'));

        $this->loginAsAdmin(Admin::factory()->create());

        $this->from('/domains')->post('/admin/subdomains')
                                ->assertRedirect('/domains');
    }

    /** @test */
    public function it_admin_cannot_add_sub_domain_without_validate_data(): void
    {
        $this->loginAsAdmin(Admin::factory()->create());

        $response = $this->from('/')->post('/admin/subdomains', [
            'sub_domain_domain' => '',
            'sub_domain_libele' => ''
        ])->assertRedirect('/');

        $response->assertSessionHasErrors(['sub_domain_domain', 'sub_domain_libele']);

        $this->assertDatabaseMissing('sub_domains', [
            'libele' => ''
        ]);
    }

    /** @test */
    public function it_store_with_validate_data(): void
    {
        $this->loginAsAdmin(Admin::factory()->create());
        $program = Program::factory()->create();
        $domain =  Domain::factory()->create(['program_id' => $program->id]);
        $response = $this->post('/admin/subdomains', [
            'sub_domain_domain' => $domain->id,
            'sub_domain_libele' => 'sub-domain-test'
        ]);

        $response->assertRedirect('/admin/domains');
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('sub_domains', [
            'domain_id' => $domain->id,
            'libele' => 'sub-domain-test',
        ]);
    }

    /** @test */
    public function admin_can_delete_sub_domain(): void
    {
        $this->loginAsAdmin(Admin::factory()->create());
        $program = Program::factory()->create();
        $domain = Domain::factory()->create(['program_id' => $program->id]);
        $subdomain = $domain->sub_domains()->create(['libele' => 'Sub-Domain-Test']);

        $this->assertCount(1, $program->domains);
        $this->assertCount(1, $domain->sub_domains);

        $response = $this->delete("/admin/subdomains/$subdomain->id/destroy");

        $response->assertStatus(302);
        $response->assertRedirect('/admin/domains');
        $response->assertSessionHas('success');
        $this->assertCount(0, $domain->fresh()->sub_domains);
        $this->assertDatabaseMissing('sub_domains', [
            'id' => $subdomain->id,
        ]);
    }
}
