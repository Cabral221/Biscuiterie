<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $admins = Admin::all();
        return view('admin.user.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
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

    public function destroy(Admin $admin)
    {
        /** @var Admin $authAdmin */
        $authAdmin = auth()->user();

        if (!$authAdmin->is_admin) {
            session()->flash('danger', 'Attention ! vous n\'avez pas les droits pour effectuer cette action !');
            return redirect()->back();
        }

        $admin->delete();
        session()->flash('success', 'L\'administrateur a bien été supprimer !');
        return redirect()->back();
    }

    public function toggleActive(Admin $admin)
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
}
