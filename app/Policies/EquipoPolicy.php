<?php

namespace App\Policies;

use App\User;
use App\Models\Equipo;
use Illuminate\Auth\Access\HandlesAuthorization;

class EquipoPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability){
        if (!$user->activo()) {
            return false;
        }
        return ($user->esAdmin())?true:null;
    }

    /**
     * Determine whether the user can view the equipo.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Equipo  $equipo
     * @return mixed
     */
    public function view(User $user, Equipo $equipo){
        return (array_search('Ver Pestaña Equipos', $user->permisos()) === false )?false:true;
    }

    /**
     * Determine whether the user can create equipos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user){
        return (array_search('Crear Equipo', $user->permisos()) === false )?false:true;
    }

    /**
     * Determine whether the user can update the equipo.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Equipo  $equipo
     * @return mixed
     */
    public function update(User $user, Equipo $equipo){
        return (array_search('Editar Equipo', $user->permisos()) === false )?false:true;
    }

    /**
     * Determine whether the user can delete the equipo.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Equipo  $equipo
     * @return mixed
     */
    public function delete(User $user, Equipo $equipo){
        return (array_search('Eliminar Equipo', $user->permisos()) === false )?false:true;
    }

    public function descargar(User $user){
        return in_array('Descargar Equipos', $user->permisos());
    }
}
