<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Niveau;
use App\Models\Program;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Get the index page of programs
     *
     * @return View
     */
    public function index() : View
    {
        $niveaux = Niveau::all();
        $programs = Program::all();

        $masters = User::all(); 
        $freeMaster = [];
        foreach ($masters as $master) {
            if($master->classe === null) $freeMaster[] = $master; 
        }
        return view('admin.programs.index', compact('programs', 'niveaux', 'freeMaster'));
    }

    /**
     * Stored domain on database
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request) : RedirectResponse
    {
        $this->validate($request, [
            'libele' => ['required', 'string'],
        ]);

        Program::create([
            'libele' => $request->libele
        ]);
        
        return redirect()->route('admin.programs.index')->with('success', 'Le programme a été ajouté avec succés ');
    }

    /**
     * Update one program
     *
     * @param Request $request
     * @param integer $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id) : RedirectResponse
    {
        $program = Program::findOrFail($id);
        $program->update(['libele' => $request->libele]);

        return redirect()->route('admin.programs.index')->with('success', 'Le programme a été modifié avec success');
    }

    /**
     * Delete one ressource of program
     *
     * @param integer $id
     * @return RedirectResponse
     */
    public function destroy (int $id) : RedirectResponse
    {
        $program = Program::findOrFail($id);
        $program->delete();

        return redirect()->route('admin.programs.index')->with('success', 'Le programme a été supprimé avec succés ');
    }
}