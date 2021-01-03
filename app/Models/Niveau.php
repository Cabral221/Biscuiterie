<?php

namespace App\Models;

use App\Models\Classe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Niveau extends Model
{
    use HasFactory;

    public $fillable = ['libele'];

    public function classes()
    {
        return $this->hasMany(Classe::class);
    }
}
