<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Notifications\MasterResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'kind',
        'email',
        'phone',
        'password',
        'matricule',
        'period',
        'is_active',
        'created_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
        'kind' => 'boolean',
        'created_at' => 'datetime',
    ];

    public static function booted()
    {
        static::creating(function($user){
            $user->password = Hash::make('password');
            $user->period = static::getPeriodForHistory(Carbon::now());
        });

        static::created(function($user) {
            History_user::create([
                'original_id' => $user->id,
                'full_name' => $user->full_name,
                'email' => $user->email,
                'phone' => $user->phone,
                'classe' => ($user->classe != null) ? $user->classe->libele : 'NEANT',
                'added_at' => $user->created_at,
                'period' => static::getPeriodForHistory($user->created_at), 
            ]);
        });

        static::updated(function($user) {
            // recupere lest record on period valide
            $current_h = History_user::where('original_id', $user->id)->latest()->first();
            // sync data
            $current_h->update([
                'full_name' => $user->full_name,
                'email' => $user->email,
                'phone' => $user->phone,
                'classe' => ($user->classe != null) ? $user->classe->libele : 'NEANT',
                'added_at' => $user->created_at,
                'period' => static::getPeriodForHistory($user->created_at), 
            ]);
        });

    } 

    public function getFullNameAttribute() 
    {
        $kind = $this->kind ? 'Mr.' : 'Mme.';
        return "{$kind} {$this->first_name} {$this->last_name}";    
    }

    public static function getPeriodForHistory(Carbon $created_at)
    {
        if($created_at->month >= 10){
            return $created_at->year . '-' . ($created_at->year + 1);
        }else{
            return $created_at->year - 1 . '-' .$created_at->year;
        }
    }

    public static function current_period()
    {
        $period = '';
        $now = Carbon::now();

        if($now->month >= 10){
            $period = $now->year . '-' . ($now->year + 1);
        }else{
            $period = $now->year - 1 . '-' .$now->year;
        }

        $users = User::where('period', $period)->orderBy('last_name', 'ASC')->get();

        return $users;

    }

    public function classe() : HasOne
    {
        return $this->hasOne(Classe::class);
    }

    /**
     * Send a password reset notification to the user.
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token) : void
    {
        $this->notify(new MasterResetPasswordNotification($token));
    }
}
