<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Publicity extends Model
{
    protected $table = "publicidad";

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'imagen',
        'sub_categoria',
        'tipo'
    ];

    /**
     * This method will be related with the model Enterprise
     * @return BelonsTo
     */
    public function enterprise(): BelongsTo
    {
        return $this->belongsTo(Enterprise::class, 'sub_categoria');
    }
}
