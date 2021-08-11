<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $table = 'categorias';

    protected $fillable = [
        'nombre',
        'ruta_img',
        'estado'
    ];

    /**
     * This method will be related with the model Category
     * @return HasMany
     */
    public function enterprises(): HasMany
    {
        return $this->hasMany(Enterprise::class, 'categoria_id');
    }
}
