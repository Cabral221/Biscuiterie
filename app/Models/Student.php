<?php

namespace App\Models;

use App\Models\Classe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    public $fillable = [
        'first_name','last_name','birthday','where_birthday','address','father_name','father_phone','mother_first_name','mother_last_name','mother_phone','classe_id'
    ];

    public $casts = [
        'birthday' => 'date',
    ];

    public function getFullNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
}
