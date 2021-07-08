<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Missing;

class MissingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Classe $classe)
    {
        $missings = $classe->missings()->orderBy('created_at', 'DESC')->get();
        foreach ($missings as $missing) {
            $missing->missingCount = $missing->missinglists()->where('missing', true)->count();
        }
        
        return view('admin.classe.missing.index', compact('classe', 'missings'));
    }

    /**
     * Show the list of one daye missing record.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Classe $classe, Missing $missing)
    {
        // dd($classe, $missing);

        $missings = $classe->missings()->orderBy('created_at', 'DESC')->get();
        foreach ($missings as $missingrec) {
            $missingrec->missingCount = $missingrec->missinglists()->where('missing', true)->count();
        }

        // return view('enseignant.missing.show', compact('missing', 'missings'));
        return view('admin.classe.missing.show', compact('classe', 'missing', 'missings'));
    }

}
