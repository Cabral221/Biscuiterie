<?php

namespace App\Http\Controllers\Master;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Missing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Missinglist;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class MissingController extends Controller
{
    public function index()
    {
        $master = auth()->user();

        if($master->classe === null) {
            session()->flash('danger', 'Vous ne disposez pas de classe pour générer une liste d\'absence');
            return redirect()->back();
        }

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

        $master->classe->missings()->create();
        session()->flash('success', 'La liste d\'absence du jour a été crée avec succés !' );
        return redirect()->back();
    }

    public function mark(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'missing_list_item' => ['required', 'numeric'],
        ]);

        if($validator->fails()) {
            return Response::json($validator->messages(), 400);
            return Response::json($validator->messages(), 400);
        }

        $missingItem = Missinglist::find($request->missing_list_item);
        $missingItem->update([
            'missing' => !$missingItem->missing
        ]);
        return Response::json(['message' => 'Modification enregistrée'], 200);
    } 
}
