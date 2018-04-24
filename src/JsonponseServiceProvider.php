<?php

namespace Jasechen\Jsonponse;

use Package\Jsonponse\Jsonponse;
use Illuminate\Support\ServiceProvider;


class JsonponseServiceProvider extends ServiceProvider
{

    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->singleton(Jsonponse::class, function () {
            return new Jsonponse;
        });
    }

}