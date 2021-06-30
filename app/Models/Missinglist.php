<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Missinglist extends Model
{
    use HasFactory;

    protected $fillable = ['student_id'];

    public $timestamps = false;

    public function missing() : BelongsTo
    {
        return $this->belongsTo(Missing::class);
    }

    public function student() : BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
