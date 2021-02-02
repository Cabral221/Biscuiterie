<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{

    /**
     * render profile page for administrateur
     *
     * @return View
     */
    public function profile() : View
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    /**
     * update info for admin
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request) : RedirectResponse
    {
        $this->validate($request, [
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'numeric']
        ]);

        $errorsMessages = [];

        /** @var Admin */
        $authUser = auth()->user();

        // Validate unique email whitout self
        $uniqueEmail = Admin::where('email', $request->email)
                            ->Where('id', '!=',$authUser->id)
                            ->first();
        if($uniqueEmail !== null){
            $errorsMessages = array_merge($errorsMessages, ['email' => 'Cette adresse email est déja utilisée']); 
        }
        // Validate unique phone whitout self
        $uniquePhone = Admin::where('phone', $request->phone)
                            ->Where('id', '!=',$authUser->id)
                            ->first();
        if($uniquePhone !== null){
            $errorsMessages = array_merge($errorsMessages, ['phone' => 'Ce numéro de téléphone est déja utilisé']); 
        }

        if(!empty($errorsMessages)){
            return redirect()->back()->withErrors($errorsMessages);
        }
        
        $authUser->update([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        session()->flash('success', 'Modifications enregistrées avec succés.');
        return redirect()->route('admin.profile');
    }

    /**
     * change password for admin
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function password(Request $request) : RedirectResponse
    {
        $this->validate($request, [
            'old_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        /** @var Admin */
        $authUser = auth()->user();

        if(Hash::check($request->old_password, $authUser->password)){
            $authUser->update([
                'password' => Hash::make($request->password)
            ]);
            
            session()->flash('success', 'Votre mot de passe a été changé avec succés');
            return redirect()->route('admin.profile');
        }

        // return back with error session
        session()->flash('danger', 'Le mot de passe ne correspond pas');
        return redirect()->back()->withErrors([
            'old_password' => 'Le mot de passe ne correspond pas',
        ]);
    }
}