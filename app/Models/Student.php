<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    public $fillable = [
        'first_name', 'last_name', 'birthday', 'where_birthday', 'address', 'father_name', 'father_phone', 'mother_first_name', 'mother_last_name', 'mother_phone', 'classe_id'
    ];

    public $casts = [
        'birthday' => 'date',
    ];

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @return BelongsTo
     */
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
}
