<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
     * This method will do upload image and get url
     * @param string $nameImage name of image
     * @param Request $request
     * @return string url of image
     */
    public static function uploadImageAndGetUrl(Request $request, string $nameImage): string
    {
        $file = $request->file($nameImage);
        $token = sha1(time());
        $nameFile = $file->getClientOriginalName();
        $nameReplace = Str::replaceArray($nameFile, [$token], $nameFile);
        Storage::disk('public')->put('enterprises' . '/' . $nameReplace . '.' . $file->extension(), File::get($file));
        return config('app.url') . '/storage/enterprises/' . $nameReplace . '.' . $file->extension();
    }

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
}
