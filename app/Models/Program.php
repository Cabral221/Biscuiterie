<?php

namespace App\Models;

use App\Models\Domain;
use App\Models\Niveau;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory;

    protected $fillable = ['libele'];

    public function niveaux() : HasMany
    {
        return $this->hasMany(Niveau::class);
    }

    public function domains() : HasMany
    {
        return $this->hasMany(Domain::class);
    }

    public function getActivities() : array
    {
        $activities = [];
        foreach($this->domains as $domain){
            if ($domain->haveSubDomain()) {
                foreach ($domain->sub_domains as $subdomain) {
                    foreach ($subdomain->activities as $activity) {
                        $activities[] = [
                            'id' => $activity->id,
                            'libele' => $activity->libele,
                            'dividente' => $activity->dividente,
                        ];
                    }
                }
            }else {
                foreach ($domain->activities as  $activity) {
                    $activities[] = [
                        'id' => $activity->id,
                        'libele' => $activity->libele,
                        'dividente' => $activity->dividente,
                    ];
                }
            }

        }

        return $activities;
    }
}
