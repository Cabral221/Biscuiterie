<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\Qualification;
use Illuminate\Http\RedirectResponse;

class EnseignantController extends Controller
{
    /**
     * render page for listing all master
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index() : View
    {
        $enseignants = User::current_period();
        return view('admin.enseignant.index', compact('enseignants'));
    }

    /**
     * render page creating master
     *
     * @return View
     */
    public function create() : View
    {
        $qualifications = Qualification::all();
        return view('admin.enseignant.create',compact('qualifications'));
    }

    /**
     * store record master on database
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request) : RedirectResponse
    {
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'kind' => ['required', 'boolean'],
            'email' => ['required', 'string', 'email', 'unique:users', 'max:255'],
            'phone' => ['required', 'numeric'],
            'matricule' => ['required', 'string', 'min:3', 'max:10', 'unique:users'],
        ]);

        $user =  User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'kind' => (bool) $request->kind,
            'email' => $request->email,
            'phone' => $request->phone,
            'matricule' => $request->matricule
        ])->qualifications()->sync($request->qualification);

        session()->flash('success', 'L\'enseignent a bien été ajouté.');
        return redirect()->route('admin.enseignants.index');
    }

    public function edit(int $id) : View
    {
        $enseignant = User::find($id);
        $qualifications = Qualification::all();
        return view('admin.enseignant.edit', compact('enseignant','qualifications'));
    }
    
    /**
     * update master info function
     *
     * @param Request $request
     * @param integer $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id) : RedirectResponse
    {
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'kind' => ['required', 'boolean'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'numeric'],
        ]);
        
        $errors = $this->validateAllUniques($request, $id);
        if(!empty($errors)){
            return redirect()->back()->withErrors($errors);
        }

        /** @var User */
        $enseignant = User::find($id);
        $enseignant->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'kind' => (bool) $request->kind,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        $enseignant->qualifications()->sync($request->qualification);
        

        session()->flash('success', 'Les modifications ont bien été prises en compte.');
        return redirect()->route('admin.enseignants.index');
    }

    /**
     * Validate Unique Function
     *
     * @param Request $request
     * @param integer $id
     * @return array<string, string>
     */
    private function validateAllUniques(Request $request, int $id) : array
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
