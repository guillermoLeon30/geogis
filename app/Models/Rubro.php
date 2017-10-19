<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rubro extends Model
{
    use SoftDeletes;

 	protected $dates = ['deleted_at'];

 	protected $fillable = ['anio', 'rubro', 'unidad', 'valor'];

 	//---------------------------------ALCANCES DE DATOS-------------------------------
    public function scopeBuscar($query, $buscar)
    {
        return $query->where('rubro', 'like', '%'.$buscar.'%');             
    }
}
