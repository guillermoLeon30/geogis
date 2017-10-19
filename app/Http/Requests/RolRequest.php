<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolRequest extends FormRequest
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
            'rol.nombre'        =>  'required|max:255',
            'rol.desripicion'   =>  'required|max:255',
            'idPermiso'         =>  'array|required'
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
            'rol.nombre.required'       =>  'El nombre del rol es obligatorio.',
            'rol.desripicion.required'  =>  'La descripcion del rol es obligatoria.',
            'idPermiso.required'        =>  'Se debe ingresar al menos un permiso.'
        ];
    }
}
