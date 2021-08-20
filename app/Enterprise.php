<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Enterprise extends Model
{
    protected $table = 'empresas';

    protected $fillable = [
        'ruc',
        'razon_social',
        'beneficio',
        'nombre_comercial',
        'categoria_id',
        'direccion',
        'telefono',
        'correo',
        'twitter',
        'facebook',
        'instagram',
        'website',
        'tipo',
        'estado',
        'ruta_small_2',
        'ruta_large_2',
        'ruta_fondo',
        'limite_cupon'
    ];

    /**
     * This method will be related with the model Enterprise
     * @return BelonsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'categoria_id');
    }

    /**
     * This method will be related with the model BranchOffice
     * @return HasMany
     */
    public function branchOffices(): HasMany
    {
        return $this->hasMany(BranchOffice::class, 'empresa_id');
    }

    /**
     * This method will be related with the model Publicity
     * @return HasMany
     */
    public function publicities(): HasMany
    {
        return $this->hasMany(Publicity::class, 'sub_categoria');
    }

    /**
     * This method will be related with the model Coupon
     * @return HasMany
     */
    public function coupons(): HasMany
    {
        return $this->hasMany(Coupon::class, 'empresa_id');
    }

    /**
     * This method will be related with the model Benefit
     * @return HasMany
     */
    public function benefits(): HasMany
    {
        return $this->hasMany(Benefit::class, 'empresa_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'empresas_users', 'user_id', 'empresas_id');
    }
}
