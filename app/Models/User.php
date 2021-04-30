<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Notifications\MasterResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'password',
        'is_active',
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
        'is_active' => 'bool',
    ];

    public static function booted()
    {
        static::created(function($user) {
            History_user::create([
                'original_id' => $user->id,
                'full_name' => $user->full_name,
                'email' => $user->email,
                'phone' => $user->phone,
                'classe' => ($user->classe != null) ? $user->classe->libele : 'NEANT',
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
                'classe' => ($user->classe != null) ? $user->classe->libele : 'NEANT'
            ]);
        });

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
