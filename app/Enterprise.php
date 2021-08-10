<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
