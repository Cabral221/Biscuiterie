<?php
namespace App\Http\Controllers\Enseignant;

use App\Http\Controllers\Controller;
use App\Models\Student;

class NoteController extends Controller
{
    
    public function index()
    {
        $user = auth()->user();
        return view('enseignant.notes.index', compact('user'));
    }

    public function show($id) 
    {
        $student = Student::findOrFail($id);
        
        return view('enseignant.notes.show', compact('student'));
    }

}
