<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApuRequest extends FormRequest
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
            'categoria_id'  =>  'required',
            'descripcion'   =>  'required',
            'unidad'        =>  'required|string|max:255'
        ];
    }
}
