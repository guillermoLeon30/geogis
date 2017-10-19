<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Proyecto extends Model
{
	protected $fillable = ['fecha', 'nombre'];
    
    //------------------------------------RELACIONES----------------------------------
	public function usuarios(){
		return $this->belongsToMany('App\User')->withPivot('creador', 'ver', 'editar');
	}

	public function categorias(){
		return $this->hasMany('App\Models\Categoria');
	}

    //---------------------------------METODOS-------------------------------
    /*******************************************************************************
    *	Funcion para buscar proyectos
    *	@in $buscar (string) 
    *	@out querrybuidel
    *********************************************************************************/
    public static function Buscar($buscar){
        return Auth::user()->belongsToMany('App\Models\Proyecto')
        			 	   ->withPivot('creador', 'ver', 'editar')
        			 	   ->where('nombre', 'like', '%'.$buscar.'%');
    }
    /*******************************************************************************
    *	Funcion para buscar categorias
    *	@in $buscar (string) 
    *	@out querrybuidel
    *********************************************************************************/
    public function buscarCategorias($buscar){
    	return $this->hasMany('App\Models\Categoria')
    				->where('nombre', 'like', '%'.$buscar.'%');
    }
     /*******************************************************************************
    *	Funcion para buscar usuarios
    *	@in $buscar (string) 
    *	@out querrybuidel
    *********************************************************************************/
    public function buscarUsuarios($buscar){
    	return $this->belongsToMany('App\User')
    				->withPivot('creador', 'ver', 'editar')
    				->where('users.id', '<>', Auth::user()->id)
    				->where('name', 'like', '%'.$buscar.'%');
    }
    /*******************************************************************************
    *	Funcion para guardar Proyectos
    *	@in $info (Request->all) 
    *	@out 
    *********************************************************************************/
    public static function guardar($info){
    	$proyecto = new Proyecto($info);
    	$proyecto->fecha = Carbon::createFromFormat('d/m/Y', $info['fecha']);
    	$proyecto->save();
    	$proyecto->usuarios()->attach(Auth::user()->id);
    }
    /*******************************************************************************
    *   Funcion para actualizar los datos del proyecto
    *   @in $info (Request->all) 
    *   @out 
    *********************************************************************************/
    public function actualizarDatos($info){
        $proyecto = $this->fill($info);
        $proyecto->fecha = Carbon::createFromFormat('d/m/Y', $info['fecha']);
        $proyecto->save();
    }
    /*******************************************************************************
    *   Funcion para actualizar los permisos al proyecto
    *   @in $info (Request->all) 
    *   @out 
    *********************************************************************************/
    public function actualizarPermisos($info){
        $this->usuarios()->sync($this->arrActualizar($info));
    }

    public function arrActualizar($info){
        if ($info['funcion'] == 'ver') {
            return [Auth::User()->id => ['creador'  =>  1,
                                         'ver'      =>  0,
                                         'editar'   =>  0], 
                    $info['user_id'] => ['creador'  =>  0,
                                         'ver'      =>  1,
                                         'editar'   =>  0]];
        }

        if ($info['funcion'] == 'editar') {
            return [Auth::User()->id => ['creador'  =>  1,
                                         'ver'      =>  0,
                                         'editar'   =>  0], 
                    $info['user_id'] => ['creador'  =>  0,
                                         'ver'      =>  0,
                                         'editar'   =>  1]];
        }
        
    }
    /*******************************************************************************
    *   Funcion para actualizar los permisos al proyecto
    *   @in $user_id ($request->user_id) 
    *   @out 
    *********************************************************************************/
    public function eliminarUsuario($user_id){
        $this->usuarios()->detach($user_id);
    }
    /*******************************************************************************
    *	Funcion entregar fecha en el formato d/m/Y
    *	@in 
    *	@out string 
    *********************************************************************************/
    public function fecha(){
    	return Carbon::createFromFormat('Y-m-d', $this->fecha)->format('d/m/Y');
    }
}
