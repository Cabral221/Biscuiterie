<?php

namespace App\Models;

use App\Models\User;
use App\Models\Niveau;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classe extends Model
{
    use HasFactory;

    public $fillable = ['libele'];

    public function niveau() : BelongsTo
    {
        return $this->belongsTo(Niveau::class);
    }

    public function students() : HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
