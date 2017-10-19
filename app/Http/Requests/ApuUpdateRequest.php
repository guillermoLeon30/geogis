<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApuUpdateRequest extends FormRequest
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
            'datos.descripcion'             =>  'required',
            'datos.unidad'                  =>  'required|string|max:255',
            'datos.por_indirectos'          =>  'integer|min:0|max:100',
            'datos.por_utilidad'            =>  'integer|min:0|max:100',
            'equipos'                       
                =>  'required_without_all:materiales,manosObra,transportes|IdsArregloDistintos',
            'equipos.*.id'                  =>  'numeric',
            'equipos.*.datos.cantidad'      =>  'numeric|min:0.01|max:999999999',
            'equipos.*.datos.rendimiento'   =>  'numeric|min:0.01|max:999999999',
            'materiales'                    
                =>  'required_without_all:equipos,manosObra,transportes|IdsArregloDistintos',
            'materiales.*.id'               =>  'numeric',
            'materiales.*.cantidad'         =>  'numeric|min:0.01|max:999999999',
            'manosObra'                     
                =>  'required_without_all:materiales,equipos,transportes|IdsArregloDistintos',
            'manosObra.*.id'                =>  'numeric',
            'manosObra.*.datos.cantidad'    =>  'numeric|min:0.01|max:999999999',
            'manosObra.*.datos.rendimiento' =>  'numeric|min:0.01|max:999999999',
            'transportes'                   
                =>  'required_without_all:materiales,manosObra,equipos|IdsArregloDistintos',
            'transportes.*.id'              =>  'numeric',
            'transportes.*.cantidad'        =>  'numeric|min:0.01|max:999999999',
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
            'datos.descripcion.required'    =>  'El campo descripcion es obligatorio.',
            'datos.unidad.required'         =>  'El campo unidad es obligatorio.',
            'datos.unidad.max'              =>  'El campo unidad debe tener un maximo de 255 caracteres.',
            'datos.por_indirectos.integer'  =>  'El campo indirectos debe ser un entero.',
            'datos.por_indirectos.min'      =>  'El campo indirectos debe ser mayor a 0.',
            'datos.por_indirectos.max'      =>  'El campo indirectos debe ser menor que 100.',
            'datos.por_utilidad.integer'    =>  'El campo indirectos debe ser un entero.',
            'datos.por_utilidad.min'        =>  'El campo indirectos debe ser mayor a 0.',
            'datos.por_utilidad.max'        =>  'El campo indirectos debe ser menor que 100.',

            'equipos.ids_arreglo_distintos'         =>  'No se puede repetir los equipos.',
            'equipos.*.id.numeric'                  =>  'Error al ingresar la tabla Equipos.',
            'equipos.*.datos.cantidad.numeric'      =>  'Error al ingresar la tabla Equipos.',
            'equipos.*.datos.cantidad.min'          =>  'Error al ingresar la tabla Equipos.',
            'equipos.*.datos.cantidad.max'          =>  'Error al ingresar la tabla Equipos.',
            'equipos.*.datos.rendimiento.numeric'   =>  'Error al ingresar la tabla Equipos.',
            'equipos.*.datos.rendimiento.min'       =>  'Error al ingresar la tabla Equipos.',
            'equipos.*.datos.rendimiento.max'       =>  'Error al ingresar la tabla Equipos.',

            'materiales.ids_arreglo_distintos'      =>  'No se puede repetir los materiales.',
            'materiales.*.id.numeric'               =>  'Error al ingresar la tabla Materiales.',
            'materiales.*.cantidad.numeric'         =>  'Error al ingresar la tabla Materiales.',
            'materiales.*.cantidad.min'             =>  'Error al ingresar la tabla Materiales.',
            'materiales.*.cantidad.max'             =>  'Error al ingresar la tabla Materiales.',

            'manosObra.ids_arreglo_distintos'       =>  'No se puede repetir los trabajadores.',
            'manosObra.*.id.numeric'                =>  'Error al ingresar la tabla Mano de Obra.',
            'manosObra.*.datos.cantidad.numeric'    =>  'Error al ingresar la tabla Mano de Obra.',
            'manosObra.*.datos.cantidad.min'        =>  'Error al ingresar la tabla Mano de Obra.',
            'manosObra.*.datos.cantidad.max'        =>  'Error al ingresar la tabla Mano de Obra.',
            'manosObra.*.datos.rendimiento.numeric' =>  'Error al ingresar la tabla Mano de Obra.',
            'manosObra.*.datos.rendimiento.min'     =>  'Error al ingresar la tabla Mano de Obra.',
            'manosObra.*.datos.rendimiento.max'     =>  'Error al ingresar la tabla Mano de Obra.',

            'transportes.ids_arreglo_distintos'     =>  'No se puede repetir los transportes.',
            'transportes.*.id.numeric'              =>  'Error al ingresar la tabla transportes.',
            'transportes.*.cantidad.numeric'        =>  'Error al ingresar la tabla Transportes.',
            'transportes.*.cantidad.min'            =>  'Error al ingresar la tabla Transportes.',
            'transportes.*.cantidad.max'            =>  'Error al ingresar la tabla Transportes.',
        ];
    }
}
