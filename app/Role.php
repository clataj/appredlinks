<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $table = "roles";

    protected $fillable = [
        'descripcion'
    ];


    public function getDescripcionAttribute(): string
    {
        return ucwords($this->attributes['descripcion']);
    }

    /**
     * This method will be related with the model User
     * @return HasMany
     */
    public function roles(): HasMany
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
