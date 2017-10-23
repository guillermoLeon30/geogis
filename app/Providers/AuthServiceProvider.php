<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\User'                  =>  'App\Policies\UserPolicy',
        'App\Models\Rubro'          =>  'App\Policies\RubroPolicy',
        'App\Models\Equipo'         =>  'App\Policies\EquipoPolicy',
        'App\Models\Rol'            =>  'App\Policies\RolPolicy',
        'App\Models\Material'       =>  'App\Policies\MaterialPolicy',
        'App\Models\ManoDeObra'     =>  'App\Policies\ManoDeObraPolicy',
        'App\Models\Transporte'     =>  'App\Policies\TransportePolicy',
        'App\Models\Proyecto'       =>  'App\Policies\ProyectoPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('UsuarioActivo', 'App\Policies\MenusPolicy@UsuarioActivo');
        Gate::define('ver-menu-items', 'App\Policies\MenusPolicy@VerMenuItems');
        Gate::define('VerMenuUsuarios', 'App\Policies\MenusPolicy@VerMenuUsuarios');
    }
}
