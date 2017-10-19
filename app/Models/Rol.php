<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
	protected $table = 'roles';

	protected $fillable = ['nombre', 'desripicion'];

	//------------------------------------RELACIONES-----------------------------------
	public function permisos()
    {
        return $this->belongsToMany('App\Models\Permiso', 'rol_permiso');
    }
    
    //---------------------------------ALCANCES DE DATOS-------------------------------
    public function scopeBuscar($query, $buscar)
    {
        return $query->where('nombre', 'like', '%'.$buscar.'%');             
    }

    //------------------------------------METODOS------------------------------------
    //Retorna un arreglo con los ids de Permiso
    public function idsPermisos()
    {
        return $this->permisos->pluck('id')->all();
    }
}
