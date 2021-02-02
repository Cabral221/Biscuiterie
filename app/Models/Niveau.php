<?php

namespace App\Models;

use App\Models\Classe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Niveau extends Model
{
    use HasFactory;

    public $fillable = ['libele'];

    public function classes() : HasMany
    {
        return $this->hasMany(Classe::class);
    }

    public function studentsCount() : int
    {
        $tot = 0;
        foreach ($this->classes()->get() as $classe) {
            $tot += $classe->students->count();
        }
        return $tot;
    }
}
