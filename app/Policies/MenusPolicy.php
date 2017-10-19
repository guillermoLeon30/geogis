<?php

namespace App\Policies;

use App\User;
use App\Models\Menus;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenusPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function UsuarioActivo(User $user)
    {
        return $user->activo();
    }

    public function VerMenuItems(User $user)
    {
        if ($user->esAdmin()) {
            return true;
        }

        return (array_search('Ver Menu Items', $user->permisos()) === false )?false:true;
    }

     public function VerMenuUsuarios(User $user)
    {
        if ($user->esAdmin()) {
            return true;
        }
        
        return (array_search('Ver Menu Usuarios', $user->permisos()) === false )?false:true;
    }
}
