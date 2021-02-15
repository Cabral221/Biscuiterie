<?php

namespace App\Models;

use App\Models\SubDomain;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = ['libele', 'program_id'];

    public function program() : BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function sub_domains() : HasMany
    {
        return $this->hasMany(SubDomain::class, 'domain_id');
    }

}
