<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Material extends Model
{
	use SoftDeletes;

	protected $fillable = ['fecha', 'fuente', 'descripcion', 'unidad', 'costo'];
	protected $dates = ['deleted_at'];
    protected $table = 'materiales';

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
