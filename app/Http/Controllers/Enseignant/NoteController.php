<?php
namespace App\Http\Controllers\Enseignant;

use App\Models\Note;
use App\Models\User;
use App\Models\Classe;
use App\Models\Student;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\Domain;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    /**
     * Return the index page for notes classe
     *
     * @return View
     */   
    public function index() : View
    {
        /** @var User */
        $user = auth()->user();

        /** @var Classe */
        $classe = $user->classe;
        
        return view('enseignant.notes.index', compact('user', 'classe'));
    }

    /**
     * Detail note for student
     *
     * @param integer $id
     * @return View
     */
    public function show(int $id) : View
    {
        $student = Student::with('notes')->findOrFail($id);

        $notes = $this->getNotesForBulletin($student->notes);
        
        return view('enseignant.notes.show', compact('student', 'notes'));
    }


    public function store(Request $request, int $id) : JsonResponse
    {
        $note = Note::with(['student.classe.user'])->findOrFail($id);

        /** @var Activity */
        $activity = $note->activity;

        $validator = Validator::make($request->all(), [
            'note' => ['required', 'numeric', 'min:0', 'max:' . $activity->dividente],
            'position' => ['required', 'integer', Rule::in([1,2,3])],
        ]);

        if($validator->fails()) {
            return Response::json($validator->messages(), 400);
        }

        /** @var Student */
        $student = $note->student;
        /** @var Classe */
        $classe = $student->classe;
        /** @var Student */
        $user = $classe->user;
        /** @var User */
        $auth = auth()->user();
        
        if($auth->id !== $user->id){
            return Response::json('Vous n\'avez pas les droits', 401);
        }

        $note->update([
            "note$request->position" => $request->note,
        ]);
        
        return Response::json([
            'id' => $note->id,
            'position' =>$request->position,
            'note' => $note["note$request->position"]
        ], 200);
    }

    public function getNotesForBulletin($notes) : iterable
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
