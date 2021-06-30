<?php

namespace App\Http\Controllers\Master;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Missing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MissingController extends Controller
{
    public function index()
    {
        $master = auth()->user();
        $missing = Missing::where('classe_id', $master->classe->id)
        ->whereDate('created_at', Carbon::now())
        ->first();

        return view('enseignant.missing.index', compact('master', 'missing'));
    }

    public function create()
    {
        /** @var User */
        $master = auth()->user();
        // test s'il n a pas de list du jour
        $listForDay = Missing::where('classe_id', $master->classe->id)
                             ->where('created_at', Carbon::now())
                             ->first();
        if($listForDay){
            session()->flash('danger', 'La liste d\'absence du jour existe déja ');
            return redirect()->back();
        }

        $missing = $master->classe->missings()->create();
        session()->flash('success', 'La liste d\'absence du jour a été crée avec succés !' );
        return redirect()->back();
    }
}
