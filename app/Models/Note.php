<?php

namespace App\Models;

use App\Models\Student;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    use HasFactory;

    /** @var array<int, string> $fillable */
    protected $fillable = ['student_id', 'activity_id', 'note1', 'note2', 'note3'];

    /** @var array<int, string> $with */
    protected $with = ['activity'];

    public function student() : BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function activity() : BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }
}
