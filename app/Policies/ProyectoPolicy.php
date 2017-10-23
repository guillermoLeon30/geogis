<?php

namespace App\Policies;

use App\User;
use App\Models\Proyecto;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class ProyectoPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if (!$user->activo()) {
            return false;
        }
    }

    /**
     * Determine whether the user can view the proyecto.
     *
     * @param  \App\User  $user
     * @param  \App\Proyecto  $proyecto
     * @return mixed
     */
    public function view(User $user, Proyecto $proyecto)
    {
        //
    }

    /**
     * Determine whether the user can create proyectos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the proyecto.
     *
     * @param  \App\User  $user
     * @param  \App\Proyecto  $proyecto
     * @return mixed
     */
    public function update(User $user, Proyecto $proyecto)
    {
        //
    }

    /**
     * Determine whether the user can delete the proyecto.
     *
     * @param  \App\User  $user
     * @param  \App\Proyecto  $proyecto
     * @return mixed
     */
    public function delete(User $user, Proyecto $proyecto)
    {
        //
    }

    public function crearPermiso(User $user, Proyecto $proyecto)
    {
        $creador = DB::table('proyecto_user')->where('user_id', $user->id)
                                             ->where('proyecto_id', $proyecto->id)
                                             ->get()
                                             ->first()
                                             ->creador;
        return ($creador == 1)?true:false;
    }

    public function editar(User $user, Proyecto $proyecto)
    {
        $pu = DB::table('proyecto_user')->where('user_id', $user->id)
                                        ->where('proyecto_id', $proyecto->id)
                                        ->get()
                                        ->first();
        return ($pu->creador == 1 || $pu->editar == 1)?true:false;
    }
}
