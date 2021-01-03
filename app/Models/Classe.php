<?php

namespace App\Models;

use App\Models\Niveau;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classe extends Model
{
    use HasFactory;

    public $fillable = ['libele'];

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
