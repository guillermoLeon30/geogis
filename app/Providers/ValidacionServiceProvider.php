<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Validacion\Validacion;
use Illuminate\Support\Facades\Lang;

class ValidacionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $messages = Lang::get('validation');
        
        Validator::resolver(function ($translator, $data, $rules, $messages)
        {
            return new Validacion($translator, $data, $rules, $messages);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
