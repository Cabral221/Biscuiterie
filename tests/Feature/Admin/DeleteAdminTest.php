<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\Admin;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class DeleteAdminTest extends TestCase 
{
    use WithoutMiddleware;
    
    /** @test */
    public function super_admin_delete_other_admin() : void
    {
        // Etant donné que je suis connecte en tant que 
        $this->loginAsAdmin(Admin::factory(['is_admin' => true])->create());
        $newAdmin = Admin::factory(['email' => "test_test@test.com"])->create();
        
        // Quand je supprime un admin
        $this->withoutMiddleware();
        $response = $this->delete("/admin/users/{$newAdmin->id}/destroy");
        
        // L'admin ne doit pas figurer dans la base de donnée
        $response->assertRedirect('/');
        $this->assertDatabaseMissing('admins', [
            'email' => $newAdmin->email,
            'phone' => $newAdmin->phone,
            ]);
    }
        
    /** @test */
    public function only_super_admin_can_delete_sub_admin() : void
    {
        // Etant donné que je suis connecte en tant que 
        $this->loginAsAdmin(Admin::factory()->create());
        $newAdmin = Admin::factory(['email' => "test_test@test.com"])->create();
            
        // Quand je supprime un admin
        $this->withoutMiddleware();
        $response = $this->delete("/admin/users/{$newAdmin->id}/destroy");
            
        // L'admin ne doit pas figurer dans la base de donnée
        $response->assertSessionHas('danger');
        $this->assertDatabaseHas('admins', [
            'email' => $newAdmin->email,
            'phone' => $newAdmin->phone,
        ]);
    }
            
    /** @test */
    public function self_delete_is_impossible() : void
    {
        // Etant donné que je suis connecte en tant que 
        $admin = Admin::factory()->create(['is_admin' => true]);
        $this->loginAsAdmin($admin);
            
        // Quand je supprime mon propre compte
        $this->withoutMiddleware();
        $response = $this->delete("/admin/users/{$admin->id}/destroy");
            
        // L'admin ne doit pas figurer dans la base de donnée
        $response->assertSessionHas('danger', 'Attention ! l\'auto-suppression est impossible !');
        $this->assertDatabaseHas('admins', [
            'email' => $admin->email,
            'phone' => $admin->phone,
        ]);
    }

    /** @test */
    public function super_admin_cant_be_deleted() : void
    {
        // Etant donné que je suis connecte en tant que Admin super sub
        $this->loginAsAdmin(Admin::factory(['is_admin' => true])->create());
        /** @var Admin */
        $superAdmin = Admin::first();
            
        // Quand je supprime le super admin
        $this->withoutMiddleware();
        $response = $this->delete("/admin/users/{$superAdmin->id}/destroy");
            
        // L'admin ne doit pas figurer dans la base de donnée
        $response->assertSessionHas('danger', 'Attention ! vous n\'avez pas les droits pour effectuer cette action !');
        $this->assertDatabaseHas('admins', [
            'email' => $superAdmin->email,
            'phone' => $superAdmin->phone,
        ]);
    }
}