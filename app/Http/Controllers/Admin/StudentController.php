<?php

namespace App\Http\Controllers\Admin;

use App\Models\Classe;
use App\Models\Niveau;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use Illuminate\Http\RedirectResponse;

class StudentController extends Controller
{

    /**
     * renvoi la page d'ajout d'éléve
     *
     * @return View
     */
    public function index() : View
    {
        $niveaux = Niveau::with('classes.students')->get();
        return view('admin.student.index', compact('niveaux'));
    }

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
            'kind' => $request->kind,
            'address' => $request->address,
            'father_name' => $request->father_name,
            'father_phone' => $request->father_phone,
            'father_nin' => $request->father_nin,
            'mother_first_name' => $request->mother_first_name,
            'mother_last_name' => $request->mother_last_name,
            'mother_phone' => $request->mother_phone,
            'mother_nin' => $request->mother_nin,
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
     * @param Request $request
     * @param Student $student
     * @return RedirectResponse
     */
    public function update(Request $request, Student $student) : RedirectResponse
    {
        $this->validate($request, [
            'classe_id' => ['required','numeric'],
            'first_name' => ['required','string','min:2'],
            'last_name' => ['required','string','min:2'],
            'birthday' => ['required','date'],
            'where_birthday' => ['required','string', 'min:2'],
            'kind' => ['required', 'boolean'],
            'address' => ['required','string','min:2'],
            'father_name' => ['string','min:2'],
            'father_phone' => ['numeric'],
            'father_nin' => ['required', 'unique:students,id'.$student->id],
            'mother_first_name' => ['string','min:2'],
            'mother_last_name' => ['string','min:2'],
            'mother_phone' => ['numeric'],
            'mother_nin' => ['required', 'unique:students,id'.$student->id]
        ]);

        $student->update([
            'classe_id' => $request->classe_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birthday' => $request->birthday,
            'where_birthday' => $request->where_birthday,
            'kind' => $request->kind,
            'address' => $request->address,
            'father_name' => $request->father_name,
            'father_phone' => $request->father_phone,
            'father_nin' => $request->father_nin,
            'mother_first_name' => $request->mother_first_name,
            'mother_last_name' => $request->mother_last_name,
            'mother_phone' => $request->mother_phone,
            'mother_nin' => $request->mother_nin,
        ]);

        session()->flash('success', 'Les modifications ont été modifié avec succés');
        return redirect()->route('admin.classes.show', $student->classe);
    }

    /**
     * delete one student by id
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id) : RedirectResponse
    {
        $student = Student::findOrFail($id);
        $student->delete();

        session()->flash('success', 'L\'éléve a bien été supprimé !');
        return redirect()->back();
    }
}
