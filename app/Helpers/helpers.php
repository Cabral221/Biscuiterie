<?php

use App\Models\User;
use App\Models\Niveau;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Route as Router;
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

if (! function_exists('activeClass')) {
    /**
     * Get the active class if the condition is not false.
     *
     * @param bool   $condition
     * @param string $activeClass
     * @param string $inactiveClass
     *
     * @return string
     */
    function activeClass(bool $condition, $activeClass = 'active', $inactiveClass = '') : String
    {
        return $condition ? $activeClass : $inactiveClass;
    }
}

if (! function_exists('activeMenuClasseOpen')) {
    /**
     * Get the active menu class.
     *
     * @param int    $niveau_id
     * @param string $activeClass
     * @param string $inactiveClass
     *
     * @return string
     */
    function activeMenuClasseOpen(int $niveau_id, $activeClass = 'active', $inactiveClass = '') : String
    {
        $currentUrl = url()->current();
        $classes =  Niveau::findOrFail($niveau_id)->classes;
        foreach ($classes as  $classe) {
            if (route('admin.classes.show',$classe->id) === $currentUrl 
                || strpos($currentUrl, "admin/classes/" . $classe->id. "/missing") !== false
                || strpos($currentUrl, "admin/classes/" . $classe->id. "/notes") !== false) 
            {
                return $activeClass;
            }
        }
        return $inactiveClass;
    }
}

if (! function_exists('activeMenuOpen')) {
    /**
     * Get the active menu class.
     *
     * @param string $prefix
     * @param string $activeClass
     * @param string $inactiveClass
     *
     * @return string
     */
    function activeMenuOpen(string $prefix, $activeClass = 'active', $inactiveClass = '') : String
    {
        /** @var Router */
        $current = Route::current();

        if ($current->action['prefix'] == $prefix) {
            return $activeClass;
        }
        return $inactiveClass;
    }
}

if (! function_exists('myClasse')) {
    
    /**
     * Get classe of the current master logging
     *
     * @return String|null
     */
    function myClasse()
    {
        /** @var User */
        $user = auth()->user();
        $classe = $user->classe;

        return $classe->libele ?? null;
    }
}

?>