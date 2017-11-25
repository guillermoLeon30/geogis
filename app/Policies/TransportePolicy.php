<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransportePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability){
        if (!$user->activo()) {
            return false;
        }
        return ($user->esAdmin())?true:null;
    }

    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user){
        return (array_search('Ver Pestaña Transporte', $user->permisos()) === false )?false:true;
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user){
        return (array_search('Crear Transporte', $user->permisos()) === false )?false:true;
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user){
        return (array_search('Editar Transporte', $user->permisos()) === false )?false:true;
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user){
        return (array_search('Eliminar Transporte', $user->permisos()) === false )?false:true;
    }

    public function descargar(User $user){
        return in_array('Descargar Transporte', $user->permisos());
    }
}
