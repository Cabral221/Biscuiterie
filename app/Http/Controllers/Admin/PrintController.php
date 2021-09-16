<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PrintController extends Controller
{
    public function classe(int $id) : View
    {        
        if(!is_int($id)) {
            throw new NotFoundHttpException('Impossible de trouvez la classe');
        } 
            
        $classe = Classe::find($id);

        if($classe == null) {
            throw new NotFoundHttpException('Impossible de trouvez la classe');
        }

        $students = $classe->students()->orderBy('last_name', 'ASC')->get();
        
        return view('print.classe', compact('classe', 'students'));
    }

    public function master() : View
    {
        $masters = User::current_period();

        if($masters->count() < 1) {
            throw new NotFoundHttpException('Impossible de trouvez les données !');
        }
        
        return view('print.master', compact('masters'));
    }
}
