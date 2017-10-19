<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use App\Models\Rol;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'estado',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //------------------------------------RELACIONES----------------------------------
    public function roles()
    {
        return $this->belongsToMany('App\Models\Rol');
    }

    //---------------------------------ALCANCES DE DATOS-------------------------------
    public function scopeBuscar($query, $buscar)
    {
        return $query->where('name', 'like', '%'.$buscar.'%');             
    }

    //-------------------------------------METODOS-------------------------------------
    /**
     * Devuelve un arreglo de ids de los roles de un usuario
     *
     * @var 
     */
    public function rolesId()
    {
        return $this->roles->transform(function ($item, $key) {
            return $item->id;
        })->all();

    }
     /**
     * Devuelve los permisos que tiene un usuario.
     *
     * @var 
     */
    public function permisos()
    {
        $arr = [];

        foreach ($this->roles as $rol) {
            foreach ($rol->permisos as $permiso) {
                array_push($arr, $permiso->nombre);
            }
        }

        return array_unique($arr);
    }

    /**
     * Devuelve true si usuario es Administrador.
     *
     * @var 
     */
    public function esAdmin()
    {
        foreach ($this->roles as $rol) {
            if ($rol->nombre == 'Administrador') {
                return true;
            }
        }

        return false;
    }

    /**
     * Devuelve true si usuario esta activo.
     *
     * @var 
     */
    public function activo()
    {
        return ($this->estado == 'Activo')?true:false;
    }

     /**
     * Devuelve el id del usuario creador del proyecto actual.
     *
     */
    public static function idCreadorProyecto($idProyecto){
        return DB::table('proyecto_user')->where([['proyecto_id', $idProyecto],
                                                  ['creador', 1]])->value('user_id');
    }
}
