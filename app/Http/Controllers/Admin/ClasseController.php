<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;

class ClasseController extends Controller
{

    /**
     * @param Classe $classe
     * @return Application|Factory|View
     */
    public function show(Classe $classe)
    {
        return view('admin.classe', compact('classe'));
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

}
