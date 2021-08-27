<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnterpriseSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ruc' => 'required',
            'razon_social' => 'required',
            'beneficio' => 'required',
            'nombre_comercial' => 'required',
            'categoria_id' => 'required|not_in:0',
            'direccion' => 'required',
            'telefono' => 'required',
            'estado' => 'required|string|not_in:0',
            'ruta_fondo' => 'image',
            'ruta_small_2' => 'image',
            'limite_cupon' => 'required'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name' => 'nombre',
            'razon_social' => 'razón social',
            'nombre_comercial' => 'nombre comercial',
            'categoria_id' => 'categoria',
            'ruta_fondo' => 'imagen de fondo',
            'ruta_small_2' => 'imagen del contenido',
            'limite_cupon' => 'limite del cupon'
        ];
    }

}
