<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Student;

class StudentTest extends TestCase
{
    /** @test */
    public function add_student() : void
    {
        // Etant donne que
        $this->loginAsAdmin(Admin::factory()->create());

        // Quand
        $student = Student::factory()->make();
        $response = $this->post('/admin/students', [
            'first_name' => $student->first_name,
            'last_name' => $student->last_name,
            'birthday' => $student->birthday,
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
            'classe_id' => $student->classe_id,
        ]);
        
        // dd($response);
        // Alors
        $response->assertSessionHas('success');
        $response->assertRedirect("/admin/classes/$student->classe_id");
        $this->assertDatabaseHas('students', [
            'first_name' => $student->first_name,
            'last_name' => $student->last_name,
            'birthday' => $student->birthday,
            'where_birthday' => $student->where_birthday,
            'kind' => $student->kind,
            'mother_nin' => 2251199700766,
            'father_nin' => 1251199700766,
        ]);
    }
    
    /** @test */
    public function edit_student() : void
    {
        // Etant donne que
        $this->loginAsAdmin(Admin::factory()->create());

        // Quand
        $student = Student::factory()->create([
            'last_name' => 'Diop',
            'where_birthday' => 'Saint Louis',
            'kind' => true,
        ]);
        $response = $this->put("/admin/students/$student->id", [
            'last_name' => 'Ndiaye',
            'where_birthday' => 'Dakar',
            'kind' => 0,

            'first_name' => $student->first_name,
            'birthday' => $student->birthday,
            'address' => $student->address,
            'father_name' => $student->father_name,
            'father_phone' => $student->father_phone,
            'father_nin' => 1251199700767,
            'mother_first_name' => $student->mother_first_name,
            'mother_last_name' => $student->mother_last_name,
            'mother_phone' => $student->mother_phone,
            'mother_nin' => 2251199700767,
            'classe_id' => $student->classe_id,
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
        ]);
    }
}