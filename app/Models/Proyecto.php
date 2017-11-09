<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Excel;

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

    /*******************************************************************************
    *   Funcion retorna total
    *   @in 
    *   @out float
    *********************************************************************************/
    public function total(){
        return round($this->categorias->map(function ($categoria, $key){
            return $categoria->total();
        })->sum(), 2);
        
    }

    /*******************************************************************************
    *   Funcion eliminar proyecto
    *   @in  
    *   @out  
    *********************************************************************************/
    public function eliminar(){
        $this->categorias->each(function ($categoria, $key){
            $categoria->eliminar();
        });
        $this->usuarios()->detach();
        $this->delete();
    }

    /*******************************************************************************
    *   Funcion para imprimir excel
    *   @in  
    *   @out  
    *********************************************************************************/
    public function excel(){
        Excel::create('proyecto', function ($excel){
            $excel->sheet('proyecto', function ($sheet){
                $sheet->fromArray($this->getProyectosForExcel(), null, 'A1', false, false);
            });

            $i=1;
            foreach ($this->categorias as $categoria) {
                foreach ($categoria->apus as $apu) {
                    $apu->hoja($excel, $i);
                    $i++;
                }
            }
        })->export('xlsx');
    }

    public function getProyectosForExcel(){
        $campos = ['ITEM', 'RUBRO', 'UNIDAD', 'CANTIDAD DE OBRA', 'PRECIO UNITARIO', 'PRECIO TOTAL'];
        $a = array($campos);

        foreach ($this->categorias as $categoria) {
            array_push($a, [$categoria->nombre]);
            foreach ($categoria->apus as $apu) {
                $cantidad = sprintf('%.2f', $apu->cantidad);
                $tg = $apu->totalGeneral();
                $pu = sprintf('%.2f', $tg);
                $total = sprintf('%.2f', ($apu->cantidad * $tg));
                $fila = ['???', $apu->descripcion, $apu->unidad,  $cantidad, $pu, $total];
                array_push($a, $fila);
            }
        }

        return $a;
    }
}
