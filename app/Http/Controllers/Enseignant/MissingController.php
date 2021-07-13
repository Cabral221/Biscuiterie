<?php

namespace App\Http\Controllers\Enseignant;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Missing;
use App\Models\Missinglist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        $builder = $master->classe->missings();
        if($missing !== null) $builder = $builder->where('id', '!=', $missing->id); 
        $missings = $builder->orderBy('created_at', 'DESC')->get();
        // foreach ($missings as $missingrec) {
        //     $missingrec->missing_count = $missingrec->missinglists()->where('missing', true)->count();
        // }

        return view('enseignant.missing.index', compact('master', 'missing', 'missings'));
    }

    public function list() 
    {
        /** @var User */
        $master = auth()->user();
        $missings = $master->classe->missings()->orderBy('created_at', 'DESC')->get();
        // foreach ($missings as $missing) {
        //     $missing->missing_count = $missing->missinglists()->where('missing', true)->count();
        // }

        return view('enseignant.missing.list', compact('master', 'missings'));
    }

    public function show(Missing $missing)
    {
        $master = auth()->user();
        $missings = $master->classe->missings()->orderBy('created_at', 'DESC')->get();
        // foreach ($missings as $missingrec) {
        //     $missingrec->missing_count = $missingrec->missinglists()->where('missing', true)->count();
        // }

        return view('enseignant.missing.show', compact('missing', 'missings'));
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
        }

        $missingItem = Missinglist::find($request->missing_list_item);
        $missingItem->update([
            'missing' => !$missingItem->missing
        ]);
        return Response::json([
            'message' => 'Modification enregistrée',
            // 'missingId' => $missingItem->id,
            // 'missingState' => $missingItem->missing,
            // 'missingStudent' => $missingItem->student_id
        ], 200);
    } 
}
