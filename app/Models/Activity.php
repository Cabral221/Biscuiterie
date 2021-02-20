<?php

namespace App\Models;

use App\Models\Note;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = ['libele', 'dividente'];

    /**
     * Get the parent activitable model (domain or sub_domain).
     * @return MorphTo
     */
    public function activitable() : MorphTo
    {
        return $this->morphTo();
    }

    public function notes() : HasMany
    {
        return $this->hasMany(Note::class);
    }
}
