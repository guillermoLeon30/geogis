<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
//use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Rubro;

class RubroPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        return ($user->esAdmin())?true:null;
    }

    /**
     * Determine whether the user can view the rubro.
     *
     */
    public function view(User $user, Rubro $rubro)
    {
        return (array_search('Ver Catalogo de Rubros', $user->permisos()) === false )?false:true;
    }

    /**
     * Determine whether the user can create rubros.
     *
     */
    public function create()
    {
        //
    }

    /**
     * Determine whether the user can update the rubro.
     *
     */
    public function update()
    {
        //
    }

    /**
     * Determine whether the user can delete the rubro.
     *
     */
    public function delete()
    {
        //
    }
}
