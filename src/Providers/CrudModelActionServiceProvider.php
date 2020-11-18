<?php

namespace Sfneal\CrudModelActions\Providers;

use Illuminate\Support\ServiceProvider;

class CrudModelActionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish config file
        $this->publishes([
            __DIR__.'/../../config/crud-model-action.php' => base_path('config/crud-model-action.php'),
        ], 'config');
    }

    public function register()
    {
        // Load config file
        $this->mergeConfigFrom(__DIR__.'/../../config/crud-model-action.php', 'crud-model-action');
    }
}
