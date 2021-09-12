<?php

namespace App\Http\Controllers\Admin;

use App\Models\Classe;
use App\Models\Missing;
use App\Models\Missinglist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class MissingController extends Controller
{
    /**
     * getDataForApi
     *
     * @param Classe $classe
     * @return View
     */
    public function index(Classe $classe) : View
    {
        $missings = $classe->missings()->orderBy('created_at', 'DESC')->get();
        
        return view('admin.classe.missing.index', compact('classe', 'missings'));
    }

    /**
     * Show the list of one daye missing record.
     *
     * @param Classe $classe
     * @param Missing $missing
     * @return View
     */
    public function list(Classe $classe, Missing $missing) : View
    {
        $missings = $classe->missings()->orderBy('created_at', 'DESC')->get();
        
        return view('admin.classe.missing.show', compact('classe', 'missing', 'missings'));
    }

    /**
     * Mark one student has missing or not
     *
     * @param Classe $classe
     * @param Request $request
     * @return JsonResponse
     */
    public function mark(Classe $classe, Request $request) : JsonResponse
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

    public function delete(Classe $classe, Request $request) : RedirectResponse
    {
        $this->validate($request, [
            'list_id' => ['required', 'numeric'],
        ]);

        $missing = Missing::find($request->list_id);
        $missing->delete();

        session()->flash('success', "La liste d'absence n°: $missing->id à bien été supprimée");
        return redirect()->route('admin.classes.missings.index', [$classe]);
    }

}
