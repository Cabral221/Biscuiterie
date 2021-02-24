<?php

namespace App\Models;

use App\Models\Note;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    public $fillable = [
        'first_name', 'last_name', 'birthday', 'where_birthday', 'address', 'father_name', 'father_phone', 'mother_first_name', 'mother_last_name', 'mother_phone', 'classe_id'
    ];

    public $casts = [
        'birthday' => 'date',
    ];

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

    public function moyennes() : array
    {
        return [];
    }
}
