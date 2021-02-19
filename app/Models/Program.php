<?php

namespace App\Models;

use App\Models\Domain;
use App\Models\Niveau;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory;

    protected $fillable = ['libele'];

    public function niveaux() : HasMany
    {
        return $this->hasMany(Niveau::class);
    }

    public function domains() : HasMany
    {
        return $this->hasMany(Domain::class);
    }
}
