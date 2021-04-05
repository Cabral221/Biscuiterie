<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{

    /**
     * render index page for listing all admins
     *
     * @return View
     */
    public function index() : View
    {
        $admins = Admin::all();
        return view('admin.user.index', compact('admins'));
    }

    /**
     * render page for create admin
     *
     * @return View
     */
    public function create() : View
    {
        return view('admin.user.create');
    }

    /**
     * flush data in data base when creating admin
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request) : RedirectResponse
    {
        $this->validate($request, [
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'phone' => ['required', 'numeric', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);

        Admin::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'is_admin' => $request->is_admin !== null ? true : false,
        ]);

        session()->flash('success', 'L\'administrateur a bien été ajouter');
        return redirect()->route('admin.users.index');
    }

    /**
     * render page for edit admin information
     *
     * @param integer $id
     * @return View
     */
    public function edit(int $id) : View
    {
        $admin = Admin::find($id);
        return view('admin.user.edit', compact('admin'));
    }

    /**
     * Update data to database 
     *
     * @param Request $request
     * @param integer $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id) : RedirectResponse
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

        /** @var Admin */
        $admin = Admin::find($id);
        $admin->update([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'is_admin' => $request->is_admin !== null ? true : false,
        ]);

        session()->flash('success', 'Les modifications ont bien été prises en compte.');
        return redirect()->route('admin.users.index');
    }

    /**
     * Delete one admin in database
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id) : RedirectResponse
    {
        /** @var Admin $authAdmin */
        $authAdmin = auth()->user();
        
        // Vérifier si c'est un super admin ou on supprime le super admin
        /** @var Admin */
        $superAdmin = Admin::first();
        if (!$authAdmin->is_admin || $id === $superAdmin->id) {
            session()->flash('danger', 'Attention ! vous n\'avez pas les droits pour effectuer cette action !');
            return redirect()->back();
        }

        // Self delete impossible
        if ($authAdmin->id === $id) {
            session()->flash('danger', 'Attention ! l\'auto-suppression est impossible !');
            return redirect()->back();
        }

        Admin::findOrFail($id)->delete();
        session()->flash('success', 'L\'administrateur a bien été supprimer !');
        return redirect()->back();
    }

    /**
     * Toggle active and dactive account for admin
     *
     * @param Admin $admin
     * @return RedirectResponse
     */
    public function toggleActive(Admin $admin) : RedirectResponse
    {
        /** @var Admin $authAdmin */
        $authAdmin = auth()->user();

        if (!$authAdmin->is_admin) {
            session()->flash('danger', 'Attention ! vous n\'avez pas les droits pour effectuer cette action !');
            return redirect()->back();
        }

        $oldToggle = $admin->is_active;
        $admin->is_active = !$admin->is_active;
        $admin->save();

        $message = $oldToggle
            ? 'Le compte a bien été désactivé'
            : 'Le compte a bien été activé';
        session()->flash('success', $message);
        return redirect()->back();
    }

    /**
     * Validate a unique email on update admin
     *
     * @param Request $request
     * @param integer $id
     * @return Array
     */
    private function validateAllUniques(Request $request, int $id) : Array
    {
        $errorsMessages = [];
        // Validate unique email whitout self
        $uniqueEmail = Admin::where('email', $request->email)
                            ->Where('id', '!=',$id)
                            ->first();
        if($uniqueEmail !== null){
            $errorsMessages = array_merge($errorsMessages, ['email' => 'Cette adresse email est déja utilisée']); 
        }
        // Validate unique phone whitout self
        $uniquePhone = Admin::where('phone', $request->phone)
                            ->Where('id', '!=',$id)
                            ->first();
        if($uniquePhone !== null){
            $errorsMessages = array_merge($errorsMessages, ['phone' => 'Ce numéro de téléphone est déja utilisé']); 
        }

        return $errorsMessages;
    } 
}
