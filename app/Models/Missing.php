<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Missing extends Model
{
    use HasFactory;

    public static function booted()
    {
        self::created(function($missing) {
            $students = $missing->classe->students;
            foreach($students as $student){
                $missing->missinglists()->create(['student_id' => $student->id]);
            }
        });
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
