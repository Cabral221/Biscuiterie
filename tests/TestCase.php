<?php

namespace Tests;

use App\Models\User;
use App\Models\Admin;
use App\Models\Niveau;
use App\Models\Student;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/**
 * Class TestCase.
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    public function setUp(): void {
        parent::setUp();

        Artisan::call('db:seed');

        $this->withoutMiddleware(RequirePassword::class);
    }

    /**
     * get the super admin
     *
     * @return Admin
     */
    protected function getMasterAdmin() : Admin
    {
        return Admin::findOrFail(1);
    }

    protected function loginAsAdmin(?Admin $admin = null) : Admin
    {
        if (! $admin) {
            $admin = $this->getMasterAdmin();
        }

        $this->actingAs($admin, 'admin');

        return $admin;
    }

    protected function loginAsMaster(User $master) : User
    {
        $this->actingAs($master);

        return $master;
    }

    protected function logout() : void
    {
        auth()->logout();
    }

    public function getMasterInitialData()
    {
        $master = User::factory()->create();
        $niveau = Niveau::factory()->create();
        $classe = $master->classe()->create([
            'libele' => 'classe test',
            'niveau_id' => $niveau->id
        ]);
       $classe->students()->create(Student::factory()->make()->toArray());
       return $master->fresh();
    }
}