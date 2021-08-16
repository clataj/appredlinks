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
        'ruta_fondo'
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
}
