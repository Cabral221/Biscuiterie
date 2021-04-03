<?php

namespace App\Models;

use App\Models\Note;
use App\Models\Classe;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    public $fillable = [
        'first_name', 'last_name', 'birthday', 'where_birthday', 'address', 'kind', 'father_name', 'father_phone', 'mother_first_name', 'mother_last_name', 'mother_phone', 'classe_id',
        'total', 'boy_count', 'girl_count',
    ];

    public $casts = [
        'birthday' => 'date',
        'kind' => 'boolean',
    ];

    protected $with = ['notes'];

    public CONST DIVIDEUR = 10;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($student) {
            // recuperer liste des matieres et on creer des notes par defaut
            $activities = $student->classe->niveau->program->getActivities();
            foreach ($activities as $activity) {
                $student->notes()->create([
                    'activity_id' => $activity['id'],
                ]);
            }

            // Incrémenter le nombre d'eleve de la classe
            /** @var Classe */
            $classe = $student->classe;
            $classe->total = $classe->total + 1;
            
            if ($student->kind) {
                // Incrémenter le nombre de Garçon Si c'est un garcon
                $classe->boy_count = $classe->boy_count + 1;
            }else{
                // Incrémenter le nombre de fille Si c'est une fille
                $classe->girl_count = $classe->girl_count + 1;
            }

            // sauvegarder
            $classe->save();
        });

        static::deleted(function ($student){
            $classe = $student->classe;
            $classe->total = $classe->total - 1;

            if ($student->kind) {
                // Décrémenter le nombre de Garçon Si c'est un garcon
                $classe->boy_count = $classe->boy_count - 1;
            }else{
                // Décrémenter le nombre de fille Si c'est une fille
                $classe->girl_count = $classe->girl_count - 1;
            }

            // sauvegarger
            $classe->save();
        });
    }

    /**
     * @return string
     */
    public function getFullNameAttribute() : string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @return BelongsTo
     */
    public function classe() : BelongsTo
    {
        return $this->belongsTo(Classe::class);
    }

    /**
     * @return HasMany
     */
    public function notes() : HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function totalGen() : array
    {
        $sommeNotes1 = null;
        $sommeNotes2 = null;
        $sommeNotes3 = null;
        foreach ($this->notes as $note) {
            $sommeNotes1 += $note->note1;
            $sommeNotes2 += $note->note2;
            $sommeNotes3 += $note->note3;
        }
        return [$sommeNotes1, $sommeNotes2, $sommeNotes3];
    }

    public function totSommeDividente() : int
    {
        $sommeDividentes = 0;
        foreach ($this->notes as $note) {
            /** @var Activity */
            $activity = $note->activity;
            $sommeDividentes += $activity->dividente;
        }

        return $sommeDividentes;
    }

    public function moy() : array
    {
        $tot = $this->totalGen();
        $sommeDividentes = $this->totSommeDividente();
        
        return [
            round($tot[0] * self::DIVIDEUR / $sommeDividentes, 2),
            round($tot[1] * self::DIVIDEUR / $sommeDividentes, 2),
            round($tot[2] * self::DIVIDEUR / $sommeDividentes, 2),
        ];
    }

    public function rang(int $position) : int
    {
        /** @var Classe */
        $classe = $this->classe;
        $allMoy = $classe->getAllMoy();
        $sortable = [];
        foreach ($allMoy as $key => $row) {
            $sortable[$key]  = $row[$position - 1];
        }
        array_multisort($sortable, SORT_DESC, $allMoy);

        $rang = 0;
        foreach ($allMoy as $key => $stat) {
            if($this->id === $stat['id']){
                $rang = (int) $key + 1;
            }
        }

        return $rang; 
    }
}
