<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function profile()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'numeric']
        ]);
        
        auth()->user()->update([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        \session()->flash('success', 'Modifications enregistrées avec succés');
        return redirect()->route('admin.profile');
    }

    public function password(Request $request)
    {
        $this->validate($request, [
            'old_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if(Hash::check($request->old_password, auth()->user()->password)){
            // Change password
            auth()->user()->update([
                'password' => Hash::make($request->password)
            ]);

            \session()->flash('success', 'Votre mot de passe a été changé avec succés');
            return \redirect()->route('admin.profile');
        }

        // return back with error session
        \session()->flash('danger', 'Le mot de passe ne correspond pas');
        return redirect()->back()->withErrors([
            'old_password' => 'Le mot de passe ne correspond pas',
        ]);
    }
}