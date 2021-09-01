<?php

namespace App\Http\Controllers\Enseignant;

use App\Models\Classe;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PrintController extends Controller
{
    public function classe($id)
    {
        $id = (int) $id;
        
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
}
