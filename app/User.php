<?php

namespace App;

use App\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * This method will convert in uppercase every word
     * @return string
     */
    public function getNameAttribute(): string
    {
        return ucwords($this->attributes['name']);
    }

    /**
     * This method will be related with the model Role
     * @return BelongsTo
     */
    public function rol(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * This method will be related with the model Enterprise
     * @return BelongsToMany
     */
    public function enterprises(): BelongsToMany
    {
        return $this->belongsToMany(Enterprise::class, 'empresas_users', 'user_id', 'empresas_id');
    }
}
