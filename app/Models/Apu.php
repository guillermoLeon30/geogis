<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Equipo;
use App\Models\Material;
use App\Models\ManoDeObra;
use App\Models\Transporte;

class Apu extends Model
{
    protected $fillable = ['categoria_id', 'descripcion', 'unidad', 'por_indirectos', 'por_utilidad', 'cantidad'];

    //------------------------------------RELACIONES----------------------------------
    public function categoria(){
        return $this->belongsTo('App\Models\Categoria');
    }

	public function equipos(){
		return $this->belongsToMany('App\Models\Equipo')->withPivot('costo_hora2', 'cantidad', 'rendimiento');
	}

	public function materiales(){
		return $this->belongsToMany('App\Models\Material')->withPivot('costo2', 'cantidad');
	}

	public function manoDeObra(){
		return $this->belongsToMany('App\Models\ManoDeObra')->withPivot('costo_hora2', 'cantidad', 'rendimiento');
	}

	public function transportes(){
		return $this->belongsToMany('App\Models\Transporte')->withPivot('costo_km2', 'cantidad');
	}

	//--------------------------------------METODOS-----------------------------------
	/*******************************************************************************
    *	Funciones para generar totales
    *	@in 
    *	@out float
    *********************************************************************************/
    public function totalEquipo(){
    	return round($this->equipos->map(function ($equipo, $key){
    		return $equipo->pivot->costo_hora2 * $equipo->pivot->cantidad * $equipo->pivot->rendimiento;
    	})->sum(), 2);
    }

    public function totalMateriales(){
    	return round($this->materiales->map(function ($material, $key){
    		return $material->pivot->costo2 * $material->pivot->cantidad;
    	})->sum(), 2);
    }

    public function totalManoDeObra(){
    	return round($this->manoDeObra->map(function ($mano, $key){
    		return $mano->pivot->costo_hora2 * $mano->pivot->cantidad * $mano->pivot->rendimiento;
    	})->sum(), 2);
    }

    public function totalTransportes(){
    	return round($this->transportes->map(function ($transporte, $key){
    		return $transporte->pivot->costo_km2 * $transporte->pivot->cantidad;
    	})->sum(), 2);
    }

    public function total(){
    	return round($this->totalEquipo() + $this->totalMateriales() + $this->totalManoDeObra() + $this->totalTransportes(), 2);
    }

    public function totalIndirectos(){
        $subtotal = $this->total();
        
        return round($subtotal * $this->por_indirectos / 100, 2);
    }

    public function totalUtilidad(){
        $subtotal = $this->total();
        
        return $utilidad = round($subtotal * $this->por_utilidad / 100, 2);
    }

    public function totalGeneral(){
        $subtotal = $this->total();
        $indirectos = round($subtotal * $this->por_indirectos / 100, 2);
        $utilidad = round($subtotal * $this->por_utilidad / 100, 2);

        return $subtotal + $indirectos + $utilidad;
    }

    public function totalApuCantidad(){
        return round($this->totalGeneral() * $this->cantidad, 2);
    }

    /*******************************************************************************
    *   Funcion estatica que retorna una lista de objetos dependiendo de la fuente
    *   @in $fuente (string) [equipos, materiales, mano_de_obra, transporte]
    *   @in $filtro (srting) valor a buscar
    *   @out (collection(obj))
    *********************************************************************************/
    public static function selectores($fuente, $filtro){
        if ($fuente == 'equipos') {
            return Equipo::buscar($filtro)->get()->take(20);
        }elseif ($fuente == 'materiales') {
            return Material::buscar($filtro)->get()->take(20);
        }elseif ($fuente == 'mano_de_obra') {
            return ManoDeObra::buscar($filtro)->get()->take(20);
        }elseif ($fuente == 'transporte') {
            return Transporte::buscar($filtro)->get()->take(20);
        }
    }

    /*******************************************************************************
    *   Funcion para actualizar apu
    *   @in $info (Request->all)
    *   @out 
    *********************************************************************************/
    public function actualizar($info){
        $this->fill($info['datos']);
        $this->save();

        if (isset($info['equipos'])) {
            $this->equipos()->sync($this->formato1Update($info['equipos']));
        }else{
            $this->equipos()->detach();
        }
        if (isset($info['materiales'])) {
            $this->materiales()->sync($this->formato2Update($info['materiales']));
        }else{
            $this->materiales()->detach();
        }
        if (isset($info['manosObra'])) {
            $this->manoDeObra()->sync($this->formato1Update($info['manosObra']));
        }else{
            $this->manoDeObra()->detach();
        }
        if (isset($info['transportes'])) {
            $this->transportes()->sync($this->formato3Update($info['transportes']));
        }else{
            $this->transportes()->detach();
        }
    }

    public function formato1Update($arr){
        $a = array();

        foreach ($arr as $v) {
            $a[$v['id']] = ['costo_hora2'   =>  $v['costo'],
                            'cantidad'      =>  $v['cantidad'],
                            'rendimiento'   =>  $v['rendimiento']];
        }

        return $a;
    }

    public function formato2Update($arr){
        $a = array();

        foreach ($arr as $v) {
            $a[$v['id']] = ['costo2'    =>  $v['costo'],
                            'cantidad'  =>  $v['cantidad']];
        }

        return $a;
    }

    public function formato3Update($arr){
        $a = array();

        foreach ($arr as $v) {
            $a[$v['id']] = ['costo_km2' =>  $v['costo'],
                            'cantidad'  =>  $v['cantidad']];
        }

        return $a;
    }

     /*******************************************************************************
    *   Funcion para eliminar apu
    *   @in 
    *   @out 
    *********************************************************************************/
    public function eliminar(){
        $this->equipos()->detach();
        $this->materiales()->detach();
        $this->manoDeObra()->detach();
        $this->transportes()->detach();
        $this->delete();
    }
}
