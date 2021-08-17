<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Coupon extends Model
{
    protected $table = "cupon";

    protected $fillable = [
        'texto',
        'descripcion',
        'cant_x_usua',
        'fecha_inicio',
        'fecha_fin',
        'num_cupon',
        'empresa_id',
        'estado',
    ];

    /**
     * This method will be related with the model Enterprise
     * @return BelonsTo
     */
    public function enterprise(): BelongsTo
    {
        return $this->belongsTo(Enterprise::class, 'empresa_id');
    }

    /**
     * This method will be related with the model Enterprise
     * @return BelonsTo
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'estado');
    }
}
