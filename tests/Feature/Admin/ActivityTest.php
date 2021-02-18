<?php

namespace Tests\Feature\Admin;

use App\Models\Activity;
use App\Models\Admin;
use App\Models\Domain;
use App\Models\SubDomain;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    /** @test */
    public function a_activity_can_be_morphed_to_a_domain_model() : void
    {
        $domain = Domain::factory()->create();
        $activity = Activity::factory()->create([
            "activitable_id" => $domain->id,
            "activitable_type" => Domain::class,
        ]);

        $this->assertInstanceOf(Domain::class, $activity->activitable);
    }

    /** @test */
    public function a_activity_can_be_morphed_to_a_sub_domain_model() : void
    {
        $domain = Domain::factory()->create();
        $subdomain = $domain->sub_domains()->create([
            'libele' => 'subDomainTest',
        ]);
        $activity = Activity::factory()->create([
            "activitable_id" => $subdomain->id,
            "activitable_type" => SubDomain::class,
        ]);

        $this->assertInstanceOf(SubDomain::class, $activity->activitable);
    }
    
    /** @test */
    public function test_store_activity_with_domain_relation() : void
    {
        $this->loginAsAdmin(Admin::factory()->create());

        $domain = Domain::factory()->create();
        $response = $this->post('/admin/activities/store', [
            'libele' => 'MatiereTest',
            'activitable_id' => $domain->id,
            'activitable_type' => get_class($domain),
        ])->assertStatus(302);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('activities', [
            'activitable_type' => get_class($domain),
            'activitable_id' => $domain->id,
        ]);
        $this->assertCount(1, $domain->fresh()->activities);
        $this->assertInstanceOf(Activity::class, $domain->fresh()->activities()->first());
    }

    /** @test */
    public function test_store_activity_with_sub_domain_relation() : void
    {
        $this->loginAsAdmin(Admin::factory()->create());

        $domain = Domain::factory()->create();
        $subdomain = $domain->sub_domains()->create([
            'libele' => 'subDomainLibele'
        ]);
        $response = $this->post('/admin/activities/store', [
            'libele' => 'MatiereTest',
            'activitable_id' => $subdomain->id,
            'activitable_type' => get_class($subdomain),
        ])->assertStatus(302);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('activities', [
            'activitable_type' => get_class($subdomain),
            'activitable_id' => $subdomain->id,
        ]);
        $this->assertCount(1, $subdomain->fresh()->activities);
        $this->assertInstanceOf(Activity::class, $subdomain->fresh()->activities()->first());
    }

    /** @test */
    public function test_unvalid_data_activity_on_store() : void
    {
        $this->loginAsAdmin(Admin::factory()->create());

        $response = $this->from('/admin/domains')->post('/admin/activities/store', [
            'libele' => '',
            'activitable_id' => '',
            'activitable_type' => 'azeaze',
        ])->assertStatus(302);
        $response->assertSessionHasErrors(['libele', 'activitable_id', 'activitable_type']);
        $response->assertRedirect('/admin/domains');
    }

    /** @test */
    public function activity_can_be_delete_on_a_domain_model(): void
    {
        $this->loginAsAdmin(Admin::factory()->create());

        $domain = Domain::factory()->create();
        $activity = Activity::factory()->create([
            "activitable_id" => $domain->id,
            "activitable_type" => Domain::class,
        ]);

        $response = $this->from('/admin/domains')
                        ->delete("/admin/activities/$activity->id/destroy")
                        ->assertStatus(302);
        $response->assertRedirect('/admin/domains');
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('activities', [
            "activitable_id" => $domain->id,
            "activitable_type" => Domain::class,
        ]);
    }

}