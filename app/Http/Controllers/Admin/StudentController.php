<?php

namespace App\Http\Controllers\Admin;

use App\Models\Classe;
use App\Models\Student;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use Illuminate\Http\RedirectResponse;

class StudentController extends Controller
{

    /**
     * flush data for new student create
     *
     * @param StudentRequest $request
     * @return RedirectResponse
     */
    public function store(StudentRequest $request) : RedirectResponse
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

    /**
     * render page for editing student
     *
     * @param Student $student
     * @return View
     */
    public function edit(Student $student) : View
    {
        $classes = Classe::all();
        return view('admin.student.edit', compact('student','classes'));
    }

    /**
     * Update information student in admin
     *
     * @param StudentRequest $request
     * @param Student $student
     * @return RedirectResponse
     */
    public function update(StudentRequest $request, Student $student) : RedirectResponse
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

    /**
     * delete one student 
     *
     * @param Student $student
     * @return RedirectResponse
     */
    public function destroy(Student $student) : RedirectResponse
    {
        $student->delete();

        session()->flash('success', 'L\'éléve a bien été supprimé !');
        return redirect()->back();
    }
}
