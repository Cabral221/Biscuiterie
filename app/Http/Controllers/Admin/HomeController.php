<?php


namespace App\Http\Controllers\Admin;


use App\Models\Niveau;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Collection;

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

        $totalStudents = $this->getTotalStudents($niveaux);
        $totalBoys = $this->getTotalBoys($niveaux);
        $totalBoysPercent = round($totalBoys * 100 / $totalStudents);
        $totalGirls = $this->getTotalGirls($niveaux);
        $totalGirlsPercent = round($totalGirls * 100 / $totalStudents);

        return view('admin.home', compact(
            'niveaux', 'bgColors', 
            'totalStudents',
            'totalBoys', 'totalBoysPercent',
            'totalGirls', 'totalGirlsPercent',
        ));
    }

    /**
     * Calculer le total de garcons de l'ecolde
     *
     * @param Collection $niveaux
     * @return integer
     */
    public function getTotalBoys(Collection $niveaux) : int
    {
        $totalBoys = 0;
        foreach($niveaux as $niveau){
            foreach($niveau->classes as $classe){
                $totalBoys += $classe->boy_count;
            }
        }

        return (int) $totalBoys;
    }

    /**
     * Undocumented function
     *
     * @param Collection $niveaux
     * @return integer
     */
    public function getTotalGirls(Collection $niveaux) : int
    {
        $totalGirls = 0;
        foreach($niveaux as $niveau){
            foreach($niveau->classes as $classe){
                $totalGirls += $classe->girl_count;
            }
        }

        return (int) $totalGirls;
    }

    /**
     * Calculer l'effectif de l'ecole
     *
     * @param Collection $niveaux
     * @return integer
     */
    public function getTotalStudents(Collection $niveaux) : int
    {
        $totalStudents = 0;
        foreach($niveaux as $niveau){
            foreach($niveau->classes as $classe){
                $totalStudents += $classe->total;
            }
        }

        return (int) $totalStudents;
    }
}
