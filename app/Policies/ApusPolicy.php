<?php

namespace App\Policies;

use App\User;
use App\Models\BlibliotecaApus as Apu;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApusPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability){
        if (!$user->activo()) {
            return false;
        }
        return ($user->esAdmin())?true:null;
    }

    /**
     * Determine whether the user can view the apu.
     *
     * @param  \App\User  $user
     * @param  \App\Apu  $apu
     * @return mixed
     */
    public function view(User $user){
        return (array_search('Ver Pestaña Apus', $user->permisos()) === false )?false:true;
    }

    /**
     * Determine whether the user can create apus.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user){
        return (array_search('Nuevo Apu en Biblioteca', $user->permisos()) === false )?false:true;
    }

    /**
     * Determine whether the user can update the apu.
     *
     * @param  \App\User  $user
     * @param  \App\Apu  $apu
     * @return mixed
     */
    public function update(User $user){
        return in_array('Editar Apu en Biblioteca', $user->permisos());
    }

    /**
     * Determine whether the user can delete the apu.
     *
     * @param  \App\User  $user
     * @param  \App\Apu  $apu
     * @return mixed
     */
    public function delete(User $user){
        return in_array('Eliminar Apu en Biblioteca', $user->permisos());
    }

    public function updateOrShow(User $user){
        $permisos = $user->permisos();
        if (in_array('Editar Apu en Biblioteca', $permisos) || in_array('Ver Apu en Biblioteca', $permisos)) {
            return true;
        }
        return false;
    }
}
