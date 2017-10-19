<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProyectoRequest extends FormRequest
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
            'fecha'     =>  'required_without_all:user_id,funcion|date_format:"d/m/Y"',
            'nombre'    =>  'required_without_all:user_id,funcion',
            'user_id'   =>  'required_without_all:nombre,fecha|integer'
        ];
    }

    public function messages()
    {
        return [
            'user_id.required_without_all'  =>  'Es necesario seleccionar un usuario.'
        ];
    }
}
