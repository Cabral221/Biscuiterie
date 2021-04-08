<?php

namespace App\Models;

use App\Models\Classe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Niveau extends Model
{
    use HasFactory;

    public $fillable = ['libele', 'program_id'];

    public function classes() : HasMany
    {
        return $this->hasMany(Classe::class);
    }

    public function program() : BelongsTo
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function studentsCount() : int
    {
        $tot = 0;
        foreach ($this->classes()->get() as $classe) {
            $tot += $classe->total;
        }
        return $tot;
    }
}
