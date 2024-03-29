<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Missing Model class
 * 
 * @method HasMany missinglists()
 */
class Missing extends Model
{
    use HasFactory;

    /** @var array<string, string> $casts */
    public $casts = [
        'created_at' => 'datetime',
    ];

    public static function booted()
    {
        self::created(function($missing) {
            $students = $missing->classe->students;
            foreach($students as $student){
                $missing->missinglists()->create(['student_id' => $student->id]);
            }
        });
    }

    public function getCreatedAtAttribute(string $created_at) : string
    {
        return Carbon::parse($created_at)->locale('fr')->calendar();
    }

    public function classe() : BelongsTo
    {
        return $this->belongsTo(Classe::class);
    }

    public function missinglists() : HasMany
    {
        return $this->hasMany(Missinglist::class);
    }
}
