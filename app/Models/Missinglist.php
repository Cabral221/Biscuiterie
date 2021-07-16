<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Missinglist extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'missing'];

    public $casts = [
        'missing' => 'boolean',
    ];

    public $timestamps = false;

    public static function booted()
    {
        static::updated(function($missinglist) {
            $missing = Missing::find($missinglist->missing_id);
            if($missinglist->missing) {
                $missing->missing_count = $missing->missing_count + 1;
            }else{
                $missing->missing_count = $missing->missing_count - 1;
            }
            $missing->save();
        });
    }

    public function missing() : BelongsTo
    {
        return $this->belongsTo(Missing::class);
    }

    public function student() : BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
