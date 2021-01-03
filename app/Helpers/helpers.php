<?php

use App\Models\Niveau;

// Helpers
/**
 * get all niveaux and classes for sidebar
 */
if (!function_exists('all_niveaux')) {
    function all_niveaux(){ 
        return Niveau::all();
    }
}



?>