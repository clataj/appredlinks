<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicityEditRequest extends FormRequest
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
            'descripcion' => 'required',
            'fecha_inicio' => 'required|date_format:Y-m-d',
            'fecha_fin' => 'required|date_format:Y-m-d',
            'estado' => 'required|string',
            'sub_categoria' => 'required|not_in:0',
            'tipo' => 'required|string'
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
            'fecha_inicio' => 'fecha de inicio',
            'fecha_fin' => 'fecha de culminación',
            'sub_categoria' => 'de la empresa',
        ];
    }
}
