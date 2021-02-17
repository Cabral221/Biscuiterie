<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    /**
     * Get the parent activitable model (domain or sub_domain).
     */
    public function activitable()
    {
        return $this->morphTo();
    }
}
