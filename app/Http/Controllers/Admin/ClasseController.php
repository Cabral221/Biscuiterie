<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

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

}
