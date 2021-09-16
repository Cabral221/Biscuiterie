<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Classe;
use App\Models\Domain;
use App\Models\Student;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class NoteController extends Controller
{
    /**
     * @param Classe $classe
     * @return View
     */
    public function index(Classe $classe) : View
    {
        /** @var User */
        $user = $classe->user;

        return view('admin.classe.note.index', compact('user', 'classe'));
    }

    public function show(Classe $classe, Student $student) : View
    {
        $notes = $this->getNotesForBulletin($student->notes);

        return view('admin.classe.note.show', compact('student', 'notes'));
    }

    /**
     * Get Note for Bulletin
     *
     * @param Iterable $notes
     * @return Iterable
     */    
    public function getNotesForBulletin(Iterable $notes) : Iterable
    {
        //  A refactoring: faire ma refont du boucle
        $lastDomain = '';
        foreach($notes as $note) {
            $activitable = $note->activity->activitable;

            if(get_class($activitable) === Domain::class){
                // Le activitable est un domain
                if($lastDomain !== $activitable->libele){
                    $note->domainExact = $activitable->libele;
                    $note->rowspanCount = $activitable->activities->count();
                    $lastDomain = $activitable->libele;
                }

            }else {
                // l'acitivitable est un soudomain
                $array["{$activitable->domain->libele}"] = [];
                $sub_domains = $activitable->domain->sub_domains;

                foreach ($sub_domains as $subDomain) {
                    $array["{$activitable->domain->libele}"][] = $subDomain->libele;
                }

                $note->domainExact = $array;
            }
        }

        return $notes;
    }
}
