<?php

namespace App\Http\Controllers\Admin;

use App\Models\Classe;
use App\Models\Missing;
use App\Models\Missinglist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

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

    public function mark(Classe $classe, Request $request)
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
            'missingState' => $missingItem->missing,
            // 'missingStudent' => $missingItem->student_id
        ], 200);
    }

}
