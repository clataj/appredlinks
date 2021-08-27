<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'empresa_id' => 'required',
            'texto' => 'required',
            'cant_x_usua' => 'required|integer',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'descripcion' => 'required'
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
            'empresa_id' => 'la empresa',
            'texto' => 'nombre del cupon',
            'cant_x_usua' => 'cantidad de cupones',
            'fecha_inicio' => 'fecha de inicio',
            'fecha_fin' => 'fecha de culminacion'
        ];
    }
}
