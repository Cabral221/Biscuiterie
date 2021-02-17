<?php

namespace App\Models;

use App\Models\Activity;
use App\Models\SubDomain;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function activities()
    {
        return $this->morphMany(Activity::class, 'activitable');
    }

    public function haveSubDomain() : bool
    {
        if ($this->sub_domains->count() > 0 ) {
            return true;
        }

        return false;
    }

}
