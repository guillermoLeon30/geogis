<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class ManoDeObra extends Model
{
    use SoftDeletes;

	protected $fillable = ['fecha', 'fuente', 'descripcion', 'costo_hora'];
	protected $dates = ['deleted_at'];

	//---------------------------------ALCANCES DE DATOS-------------------------------
    public function scopeBuscar($query, $buscar)
    {
        return $query->where('descripcion', 'like', '%'.$buscar.'%');             
    }

    //-------------------------------------METODOS-------------------------------------

    public function fecha()
    {
    	return Carbon::createFromFormat('Y-m-d', $this->fecha)->format('d/m/Y');
    }
}
