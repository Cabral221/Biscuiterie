<?php

use App\Models\Niveau;
use Illuminate\Database\Eloquent\Collection;

if (!function_exists('all_niveaux')) {

    /**
     * for getting all niveaux in array
     *
     * @return Collection<Niveau>
     */
    function all_niveaux() : Collection
    { 
        return Niveau::with('classes')->get();
    }
}

?>