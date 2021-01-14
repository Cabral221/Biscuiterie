<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EnseignantController extends Controller
{
    
    public function index()
    {
        $enseignants = User::all();
        return view('admin.enseignant.index', compact('enseignants'));
    }

    public function edit(int $id)
    {
        $enseignant = User::find($id);
        return view('admin.enseignant.edit', compact('enseignant'));
    }
    
    public function update(Request $request, int $id)
    {
        $this->validate($request, [
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'numeric'],
        ]);
        
        $errors = $this->validateAllUniques($request, $id);
        if(!empty($errors)){
            return redirect()->back()->withErrors($errors);
        }

        $enseignant = User::find($id);
        $enseignant->update([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        session()->flash('success', 'Les modifications ont bien été prises en compte.');
        return redirect()->route('admin.enseignants.index');
    }

    private function validateAllUniques($request, $id)
    {
        $errorsMessages = [];
        // Validate unique email whitout self
        $uniqueEmail = User::where('email', $request->email)
                            ->Where('id', '!=',$id)
                            ->first();
        if($uniqueEmail !== null){
            $errorsMessages = array_merge($errorsMessages, ['email' => 'Cette adresse email est déja utilisée']); 
        }
        // Validate unique phone whitout self
        $uniquePhone = User::where('phone', $request->phone)
                            ->Where('id', '!=',$id)
                            ->first();
        if($uniquePhone !== null){
            $errorsMessages = array_merge($errorsMessages, ['phone' => 'Ce numéro de téléphone est déja utilisé']); 
        }

        return $errorsMessages;
        
    } 
    
}
