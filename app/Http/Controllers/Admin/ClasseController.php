<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class ClasseController extends Controller
{

    /**
     * @param Classe $classe
     * @return Application|Factory|View
     */
    public function show(Classe $classe)
    {
        return view('admin.classe.index', compact('classe'));
    }

    /**
     * Store the classe on database
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'libele' => ['required', 'string', 'min:2', 'max:10','unique:classes,libele'],
            'niveau_id' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
        ]);

        if($validator->fails()) {
            return Response::json($validator->messages(), 400);
        }

        /** @var User */
        $user = User::find($request->user_id);
        if($user->classe != null){
            return Response::json(['user_id' => 'L\'enseignant(e) posséde déjà une classe'], 400);
        }

        $classe = Classe::create([
            'libele' => $request->libele,
            'niveau_id' => $request->niveau_id,
            'user_id' => $request->user_id,
        ]);

        return Response::json($classe->getAttributes(), 200);
    }

    /**
     * update Classe model
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request , $id) : RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'libele' => ['required', 'string', 'min:2', 'max:10'],
        ]);

        if($validator->fails()) {
            session()->flash('danger', $validator->messages()->first());
            return back();
        }

        $update_class = Classe::where('id',$id)->first();
        $update_class->libele = $request->libele;
        $update_class->save();

        return back()->with('success','Classe modifier avec success');
    }

    /**
     * delete classe 
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id) : RedirectResponse
    {
        Classe::find($id)->delete();
        return back()->with('success','Classe supprimer avec success');
    }

}
