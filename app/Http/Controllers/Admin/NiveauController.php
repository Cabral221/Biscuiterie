<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Niveau;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class NiveauController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'libele' => ['required', 'string', 'min:2', 'max:10','unique:niveaux,libele'],
            'program_id' => ['required', 'integer'],
        ]);

        if($validator->fails()) {
            return Response::json($validator->messages(), 400);
        }

        $niveau = Niveau::create([
            'libele' => $request->libele,
            'program_id' => $request->program_id,   
        ]);

        return Response::json($niveau->getAttributes(), 200);
        
    }
}
