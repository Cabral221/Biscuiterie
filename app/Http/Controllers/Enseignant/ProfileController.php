<?php

namespace App\Http\Controllers\Enseignant;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    /**
     * Render Profile page for master
     *
     * @return View
     */
    public function index() : View
    {
        $user = auth()->user();
        return view('enseignant.profile', compact('user'));
    }

    public function update(Request $request) : RedirectResponse
    {
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'kind' => ['required', 'boolean'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'numeric']
        ]);

        $errorsMessages = [];

        /** @var User */
        $authUser = auth()->user();

        // Validate unique email whitout self
        $uniqueEmail = User::where('email', $request->email)
            ->Where('id', '!=', $authUser->id)
            ->first();
        if ($uniqueEmail !== null) {
            $errorsMessages = array_merge($errorsMessages, ['email' => 'Cette adresse email est déja utilisée']);
        }
        // Validate unique phone whitout self
        $uniquePhone = User::where('phone', $request->phone)
            ->Where('id', '!=', $authUser->id)
            ->first();
        if ($uniquePhone !== null) {
            $errorsMessages = array_merge($errorsMessages, ['phone' => 'Ce numéro de téléphone est déja utilisé']);
        }

        if (!empty($errorsMessages)) {
            return redirect()->back()->withErrors($errorsMessages);
        }

        $authUser->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'kind' => (bool) $request->kind,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        session()->flash('success', __('Profile successfully updated.'));
        return redirect()->route('master.profile');
    }

    /**
     * change password for admin
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function password(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'current_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        /** @var User */
        $authUser = auth()->user();
        
        if (Hash::check($request->current_password, $authUser->password)) {
            $authUser->update([
                'password' => Hash::make($request->password)
            ]);
            session()->flash('success', __('Password successfully updated.'));
            return redirect()->route('master.profile');
        }

        return redirect()->back()->withErrors([
            'current_password' => 'Le mot de passe ne correspond pas',
        ]);
    }
}