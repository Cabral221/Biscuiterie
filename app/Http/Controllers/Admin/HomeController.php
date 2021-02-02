<?php


namespace App\Http\Controllers\Admin;


use App\Models\Classe;
use App\Models\Niveau;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function home()
    {
        $bgColors = ['aqua', 'green', 'yellow', 'red', 'purple', 'teal'];
        $niveaux = Niveau::with('classes.students')->get();
        return view('admin.home', compact('niveaux', 'bgColors'));
    }
}
