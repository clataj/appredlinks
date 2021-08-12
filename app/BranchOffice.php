<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchOffice extends Model
{
    protected $table = "sucursales";

    protected $fillable = [
        'empresa_id',
        'qr',
        'nombre',
        'direccion',
        'telefono',
        'longitud_map',
        'latitud_map',
        'estado',
        'ciudad_id'
    ];

    /**
     * This method will be related with the model Enterprise
     * @return BelonsTo
     */
    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class, 'empresa_id');
    }

    /**
     * This method will be related with the model City
     * @return BelonsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'ciudad_id');
    }
}
