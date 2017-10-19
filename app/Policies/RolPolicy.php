<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if (!$user->activo()) {
            return false;
        }
        return ($user->esAdmin())?true:null;
    }

    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return (array_search('Ves Pestaña Roles', $user->permisos()) === false )?false:true;
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (array_search('Crear Rol', $user->permisos()) === false )?false:true;
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        return (array_search('Editar Rol', $user->permisos()) === false )?false:true;
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return (array_search('Eliminar Rol', $user->permisos()) === false )?false:true;
    }
}
