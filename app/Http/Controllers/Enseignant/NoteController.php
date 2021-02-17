<?php
namespace App\Http\Controllers\Enseignant;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Contracts\View\View;

class NoteController extends Controller
{
    /**
     * Return the index page for notes classe
     *
     * @return View
     */   
    public function index() : View
    {
        $user = auth()->user();
        return view('enseignant.notes.index', compact('user'));
    }

    /**
     * Detail note for student
     *
     * @param integer $id
     * @return View
     */
    public function show(int $id) : View
    {
        $student = Student::findOrFail($id);
        
        return view('enseignant.notes.show', compact('student'));
    }

}
