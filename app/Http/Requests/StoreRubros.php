<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRubros extends FormRequest
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
            'anio'      =>  'required|numeric',
            'rubro'     =>  'required',
            'unidad'    =>  'required',
            'valor'     =>  'required|numeric'
        ];
    }

     /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'anio.required'     =>  'El campo año es obligatorio.',
            'rubro.required'    =>  'El campo rubro es obligatorio.',
            'unidad.required'   =>  'El campo unidad es obligatorio.',
            'valor.required'    =>  'El campo valor es obligatorio.',
            'anio.numeric'      =>  'El campo año debe ser un numero.'
        ];
    }
}
