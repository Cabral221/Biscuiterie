<?php

namespace App\Models;

use App\Models\Note;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    public $fillable = [
        'first_name', 'last_name', 'birthday', 'where_birthday', 'address', 'father_name', 'father_phone', 'mother_first_name', 'mother_last_name', 'mother_phone', 'classe_id'
    ];

    public $casts = [
        'birthday' => 'date',
    ];

    protected $with = ['notes'];

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

    public function moy() : array
    {
        $tot = $this->totalGen();

        $sommeDividentes = null;
        foreach ($this->notes as $note) {
            /** @var Activity */
            $activity = $note->activity;

            $sommeDividentes += $activity->dividente;
        }
        
        return [
            round($tot[0] * 10 / $sommeDividentes, 2),
            round($tot[1] * 10 / $sommeDividentes, 2),
            round($tot[2] * 10 / $sommeDividentes, 2),
        ];
    }
}
