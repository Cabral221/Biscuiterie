<?php

namespace Tests\Feature\Admin;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\Classe;
use App\Models\Country;
use App\Models\Student;
use App\Models\User;

class StudentTest extends TestCase
{
    /** @test */
    public function add_student() : void
    {
        // Etant donne que
        $this->loginAsAdmin(Admin::factory()->create());

        // Quand
        $country = Country::factory()->create([
            'code' => 'XX',
            'name' => 'X Country',
        ]);

        $master = User::factory()->create();
        $classe = Classe::factory()->create(['niveau_id' => 1, 'user_id' => $master->id]);
        $student = Student::factory()->make();
        $response = $this->post('/admin/students', [
            'first_name' => $student->first_name,
            'last_name' => $student->last_name,
            'birthday' => Carbon::CreateFromFormat('d/m/Y', $student->birthday),
            'where_birthday' => $student->where_birthday,
            'kind' => $student->kind,
            'address' => $student->address,
            'father_name' => $student->father_name,
            'father_phone' => $student->father_phone,
            'father_nin' => 1251199700766,
            'mother_first_name' =>$student->mother_first_name,
            'mother_last_name' => $student->mother_last_name,
            'mother_nin' => 2251199700766,
            'mother_phone' => $student->mother_phone,
            'classe_id' => $classe->id,
            'country_id' => $country->id,
        ]);
        $student = Student::orderBy('created_at', 'DESC')->first();

        // Alors
        $response->assertSessionHas('success');
        $response->assertRedirect("/admin/classes/$student->classe_id");
        $this->assertDatabaseHas('students', $student->getAttributes());
    }
    
    /** @test */
    public function edit_student() : void
    {
        // Etant donne que
        $this->loginAsAdmin(Admin::factory()->create());

        // Quand
        $country = Country::factory()->create(['code' => 'XX', 'name' => 'X contry']);
        $master = User::factory()->create();
        $classe = Classe::factory()->create(['niveau_id' => 1, 'user_id' => $master->id]);

        $student = Student::factory()->create([
            'last_name' => 'Diop',
            'where_birthday' => 'Saint Louis',
            'kind' => true,
            'classe_id' => $classe->id
        ]);
        $response = $this->put("/admin/students/$student->id", [
            'last_name' => 'Ndiaye',
            'where_birthday' => 'Dakar',
            'kind' => 0,

            'first_name' => $student->first_name,
            'birthday' => Carbon::CreateFromFormat('d/m/Y', $student->birthday),
            'address' => $student->address,
            'father_name' => $student->father_name,
            'father_phone' => $student->father_phone,
            'father_nin' => 1251199700767,
            'mother_first_name' => $student->mother_first_name,
            'mother_last_name' => $student->mother_last_name,
            'mother_phone' => $student->mother_phone,
            'mother_nin' => 2251199700767,
            'classe_id' => $student->classe_id,
            'country_id' => $country->id,
        ]);
        
        // Alors
        $response->assertSessionHas('success');
        $response->assertRedirect("/admin/classes/$student->classe_id");
        $this->assertDatabaseHas('students', [
            'last_name' => 'Ndiaye',
            'where_birthday' => 'Dakar',
            'kind' => 0,
            'father_nin' => 1251199700767,
            'mother_nin' => 2251199700767,
            'country_id' => $country->id,
        ]);
    }
}