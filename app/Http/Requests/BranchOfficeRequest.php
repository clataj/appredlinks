<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchOfficeRequest extends FormRequest
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
            'nombre' => 'required',
            'ciudad_id' => 'required|not_in:0',
            'estado' => 'required|string',
            'qr' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'latitud_map' => 'required',
            'longitud_map' => 'required',
            'dias_laborales' => 'required',
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
            'dias_laborales' => 'horario de la semana',
            'nombre' => 'nombre de la sucursal',
            'ciudad_id' => 'ciudad',
            'latitud_map' => 'latitud del mapa',
            'longitud_map' => 'longitud del mapa'
        ];
    }

}
