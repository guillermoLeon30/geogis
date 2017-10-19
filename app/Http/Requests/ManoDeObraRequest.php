<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManoDeObraRequest extends FormRequest
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
            'fecha'         =>  'required|date_format:"d/m/Y"',
            'fuente'        =>  'required|string|max:255',
            'descripcion'   =>  'required',
            'costo_hora'    =>  'required|numeric|max:99999999|min:0.01'
        ];
    }
}
