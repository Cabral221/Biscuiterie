<?php

use App\Models\Niveau;
use Illuminate\Database\Eloquent\Collection;

// Helpers
/**
 * get all niveaux and classes for sidebar
 */
if (!function_exists('all_niveaux')) {

    /**
     * for getting all niveaux in array
     *
     * @return Collection<Niveau>
     */
    function all_niveaux() : Collection
    { 
        return Niveau::all();
    }
}



?>