<?php

namespace App\Models;

use App\Models\Domain;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class SubDomain extends Model
{
    use HasFactory;

    protected $fillable = ['libele', 'domain_id'];

    public function domain() : BelongsTo
    {
        return $this->belongsTo(Domain::class, 'domain_id');
    }


    public function activities() : MorphMany
    {
        return $this->morphMany(Activity::class, 'activitable');
    }
}
