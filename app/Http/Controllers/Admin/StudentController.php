<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\Classe;
use App\Models\Student;

class StudentController extends Controller
{

    public function store(StudentRequest $request)
    {

        /** @var Student $student */
        $student = Student::create([
            'classe_id' => $request->classe_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birthday' => $request->birthday,
            'where_birthday' => $request->where_birthday,
            'address' => $request->address,
            'father_name' => $request->father_name,
            'father_phone' => $request->father_phone,
            'mother_first_name' => $request->mother_first_name,
            'mother_last_name' => $request->mother_last_name,
            'mother_phone' => $request->mother_phone,
        ]);

        session()->flash('success', "L'éléve {$student->fullName} a bien été ajouté(e).");
        return redirect()->route('admin.classes.show', $student->classe);
    }

    public function edit(Student $student)
    {
        $classes = Classe::all();
        return view('admin.student.edit', compact('student','classes'));
    }

    public function update(StudentRequest $request, Student $student)
    {
        $student->update([
            'classe_id' => $request->classe_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birthday' => $request->birthday,
            'where_birthday' => $request->where_birthday,
            'address' => $request->address,
            'father_name' => $request->father_name,
            'father_phone' => $request->father_phone,
            'mother_first_name' => $request->mother_first_name,
            'mother_last_name' => $request->mother_last_name,
            'mother_phone' => $request->mother_phone,
        ]);

        session()->flash('success', 'Les modifications ont été modifié avec succés');
        return redirect()->route('admin.classes.show', $student->classe);
    }

    public function destroy(Student $student)
    {
        $student->delete();

        session()->flash('success', 'L\'éléve a bien été supprimé !');
        return redirect()->back();
    }
}
