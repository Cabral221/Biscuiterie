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
}
