<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
                    ->where('descripcion', 'like', '%'.$buscar.'%');
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
}
