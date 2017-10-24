<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Equipo;
use App\Models\Material;
use App\Models\ManoDeObra;
use App\Models\Transporte;

class BibliotecaApus extends Model
{
	protected $fillable = ['descripcion', 'unidad', 'por_indirectos'];

	//------------------------------------RELACIONES----------------------------------
	public function equipos(){
		return $this->belongsToMany('App\Models\Equipo', 'equipo_biblioteca_apus', 'biblioteca_apu_id')->withPivot('cantidad', 'rendimiento');
	}

	public function materiales(){
		return $this->belongsToMany('App\Models\Material', 'material_biblioteca_apus', 'biblioteca_apu_id')->withPivot('cantidad');
	}

	public function manoDeObra(){
		return $this->belongsToMany('App\Models\ManoDeObra', 'mano_de_obra_biblioteca_apus', 'biblioteca_apu_id')->withPivot('cantidad', 'rendimiento');
	}

	public function transportes(){
		return $this->belongsToMany('App\Models\Transporte', 'transporte_biblioteca_apus', 'biblioteca_apu_id')->withPivot('cantidad');
	}

	//---------------------------------ALCANCES DE DATOS-------------------------------
    public function scopeBuscar($query, $buscar)
    {
        return $query->where('descripcion', 'like', '%'.$buscar.'%');             
    }
    
    //--------------------------------------METODOS-----------------------------------
    /*******************************************************************************
    *	Funcion estatica que retorna una lista de objetos dependiendo de la fuente
    *	@in $fuente (string) [equipos, materiales, mano_de_obra, transporte]
    *	@in $filtro (srting) valor a buscar
    *	@out (collection(obj))
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
    *	Funcion para guardar biblioteca apus
    *	@in $info (Request->all) 
    *	@out 
    *********************************************************************************/
    public static function guardar($info){
     	$apu = new BibliotecaApus($info['datos']);
     	$apu->por_utilidad = 0;
     	$apu->save();
     	if (isset($info['equipos'])) {
     		$apu->equipos()->attach($apu->formato1Attach($info['equipos']));
     	}
     	if (isset($info['materiales'])) {
     		$apu->materiales()->attach($apu->formato2Attach($info['materiales']));
     	}
     	if (isset($info['manosObra'])) {
     		$apu->manoDeObra()->attach($apu->formato1Attach($info['manosObra']));
     	}
     	if (isset($info['transportes'])) {
     		$apu->transportes()->attach($apu->formato2Attach($info['transportes']));
     	}
    }

    public function formato1Attach($arr){
    	$a = array();

    	foreach ($arr as $v) {
    		$a[$v['id']] = ['cantidad'		=> $v['datos']['cantidad'],
    					    'rendimiento'	=> $v['datos']['rendimiento']];
    	}

    	return $a;
    }

    public function formato2Attach($arr){
    	$a = array();

    	foreach ($arr as $v) {
    		$a[$v['id']] = ['cantidad'	=> $v['cantidad']];
    	}

    	return $a;
    }

    /*******************************************************************************
    *   Funcion para guardar biblioteca apus
    *   @in $info (Request->all)
    *   @in $apu   (Registro a actualizar)
    *   @out 
    *********************************************************************************/
    public static function actualizar($info, $apu){
        $apu->fill($info['datos']);
        $apu->save();

        if (isset($info['equipos'])) {
            $apu->equipos()->sync($apu->formato1Update($info['equipos']));
        }else{
            $apu->equipos()->detach();
        }
        if (isset($info['materiales'])) {
            $apu->materiales()->sync($apu->formato2Update($info['materiales']));
        }else{
            $apu->materiales()->detach();
        }
        if (isset($info['manosObra'])) {
            $apu->manoDeObra()->sync($apu->formato1Update($info['manosObra']));
        }else{
            $apu->manoDeObra()->detach();
        }
        if (isset($info['transportes'])) {
            $apu->transportes()->sync($apu->formato2Update($info['transportes']));
        }else{
            $apu->transportes()->detach();
        }
    }

    public function formato1Update($arr){
        $a = array();
        foreach ($arr as $v) {
            $a[$v['id']] = ['cantidad'      =>  $v['cantidad'],
                            'rendimiento'   =>  $v['rendimiento']];
        }

        return $a;
    }

    public function formato2Update($arr){
        $a = array();

        foreach ($arr as $v) {
            $a[$v['id']] = ['cantidad'  =>  $v['cantidad']];
        }

        return $a;
    }

     /*******************************************************************************
    *   Funcion para eliminar biblioteca apus
    *   @in $info (Request->all) 
    *   @out 
    *********************************************************************************/
    public function eliminar(){
        $this->equipos()->detach();
        $this->materiales()->detach();
        $this->manoDeObra()->detach();
        $this->transportes()->detach();
        $this->delete();
    }

    /*******************************************************************************
    *	Funciones para generar totales
    *	@in 
    *	@out float
    *********************************************************************************/
    public function totalEquipo(){
    	return round($this->equipos->map(function ($equipo, $key){
    		return $equipo->costo_hora * $equipo->pivot->cantidad * $equipo->pivot->rendimiento;
    	})->sum(), 2);
    }

    public function totalMateriales(){
    	return round($this->materiales->map(function ($material, $key){
    		return $material->costo * $material->pivot->cantidad;
    	})->sum(), 2);
    }

    public function totalManoDeObra(){
    	return round($this->manoDeObra->map(function ($mano, $key){
    		return $mano->costo_hora * $mano->pivot->cantidad * $mano->pivot->rendimiento;
    	})->sum(), 2);
    }

    public function totalTransportes(){
    	return round($this->transportes->map(function ($transporte, $key){
    		return $transporte->costo_km * $transporte->pivot->cantidad;
    	})->sum(), 2);
    }

    public function total(){
    	return round($this->totalEquipo() + $this->totalMateriales() + $this->totalManoDeObra() + $this->totalTransportes(), 2);
    }
}
