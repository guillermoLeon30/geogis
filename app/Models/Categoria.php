<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Apu;
use App\Models\Proyecto;

class Categoria extends Model
{
    protected $fillable = ['proyecto_id', 'nombre'];

    //------------------------------------RELACIONES----------------------------------
    public function proyecto(){
    	return $this->belongsTo('App\Models\Proyecto');
    }

    public function apus(){
        return $this->hasMany('App\Models\Apu');
    }

    //---------------------------------METODOS--------------------------------------
    /*******************************************************************************
    *   Funcion para buscar apus
    *   @in $buscar (string) 
    *   @out querrybuidel
    *********************************************************************************/
    public function buscarApus($buscar){
        return $this->hasMany('App\Models\Apu')
                    ->where('descripcion', 'like', '%'.$buscar.'%')
                    ->orderBy('codigo');
    }
    /*******************************************************************************
    *   Funcion para actualizar los datos
    *   @in $info (Request->all) 
    *   @out 
    *********************************************************************************/
    public function actualizarDatos($info){
        $this->fill($info);
        $this->save();
    }

    /*******************************************************************************
    *   Funcion retorna total
    *   @in  
    *   @out $float 
    *********************************************************************************/
    public function total(){
        return round($this->apus->map(function ($apu, $key){
            return $apu->totalApuCantidad();
        })->sum() ,2);
    }

    /*******************************************************************************
    *   Funcion eliminar categoria
    *   @in  
    *   @out  
    *********************************************************************************/
    public function eliminar(){
        $this->apus->each(function ($apu, $key){
            $apu->eliminar();
        });
        $this->delete();
        $this->actualizarCodigos();
    }

    public function actualizarCodigos(){
        $i=1;
        foreach ($this->proyecto->categorias->sortBy('codigo') as $categoria) {
            $categoria->codigo=$i;
            $categoria->save();
            $i++;
        }
    }

    /*******************************************************************************
    *   Funcion crear categoria
    *   @in  $request->all()
    *   @out  
    *********************************************************************************/
    public static function crear($datos){
        $categoria = new Categoria($datos);
        $categoria->codigo = Categoria::generarCodigo($datos['proyecto_id']);
        $categoria->save();
    }

    public static function generarCodigo($proyecto_id){
        $codigo = Proyecto::findOrFail($proyecto_id)->categorias->max('codigo');

        return (is_null($codigo))?1:$codigo+1;
    }

    /*******************************************************************************
    *   Funcion para copiar un apu de la biblioteca la proyecto
    *   @in  Biblioteca Apus $apu
    *   @out  
    *********************************************************************************/
    public function copiar($apu){
        $equipos = $apu->equipos;
        $materiales = $apu->materiales;
        $manoDeObra = $apu->manoDeObra;
        $transportes = $apu->transportes;

        $apuNuevo = $this->nuevoApu($apu);

        if ($equipos->isNotEmpty()) {
            $apuNuevo->equipos()->attach($this->formato1Copia($equipos));
        }

        if ($materiales->isNotEmpty()) {
            $apuNuevo->materiales()->attach($this->formato2Copia($materiales));
        }

        if ($manoDeObra->isNotEmpty()) {
            $apuNuevo->manoDeObra()->attach($this->formato1Copia($manoDeObra));
        }

        if ($transportes->isNotEmpty()) {
            $apuNuevo->transportes()->attach($this->formato3Copia($transportes));
        }
    }

    public function nuevoApu($apu){
        $apuNuevo = new Apu();
        $apuNuevo->categoria_id = $this->id;
        $apuNuevo->codigo = $apuNuevo->generarCodigo($this->id);
        $apuNuevo->descripcion = $apu->descripcion;
        $apuNuevo->unidad = $apu->unidad;
        $apuNuevo->por_indirectos = $apu->por_indirectos;
        $apuNuevo->save();

        return $apuNuevo;
    }

    public function formato1Copia($objs){
        $a = array();

        foreach ($objs as $obj) {
            $a[$obj->id] = ['costo_hora2'    =>  $obj->costo_hora,
                            'cantidad'       =>  $obj->pivot->cantidad,
                            'rendimiento'    =>  $obj->pivot->rendimiento];
        }

        return $a;
    }

    public function formato2Copia($objs){
        $a = array();

        foreach ($objs as $obj) {
            $a[$obj->id] = ['costo2'    =>  $obj->costo,
                            'cantidad'  =>  $obj->pivot->cantidad];
        }

        return $a;
    }

    public function formato3Copia($objs){
        $a = array();

        foreach ($objs as $obj) {
            $a[$obj->id] = ['costo_km2' =>  $obj->costo_km,
                            'cantidad'  =>  $obj->pivot->cantidad];
        }

        return $a;
    }

    /*******************************************************************************
    *   Funcion para mover la posicion del codigo hacia arriba o sea hacia 1
    *   @in  
    *   @out  
    *********************************************************************************/
    public function moverCodigoArriba(){
        $categoriaAnterior = Categoria::where([['proyecto_id', $this->proyecto_id],
                                               ['codigo', $this->codigo - 1]])->get()->last();
        $categoriaAnterior->codigo = $this->codigo;
        $categoriaAnterior->save();
        $this->codigo = $this->codigo - 1;
        $this->save();
    }

    /*******************************************************************************
    *   Funcion para mover la posicion del codigo hacia arriba o sea hacia 1
    *   @in  
    *   @out  
    *********************************************************************************/
    public function moverCodigoAbajo(){
        $categoriaSiguiente = Categoria::where([['proyecto_id', $this->proyecto_id],
                                                ['codigo', $this->codigo + 1]])->get()->last();
        $categoriaSiguiente->codigo = $this->codigo;
        $categoriaSiguiente->save();
        $this->codigo = $this->codigo + 1;
        $this->save();
    }

    /*******************************************************************************
    *   Funcion para obtener la ultima categoria
    *   @in  
    *   @out  
    *********************************************************************************/
    public static function ultima($proyecto){
        return $proyecto->categorias->sortBy('codigo')->last();
    }
}
