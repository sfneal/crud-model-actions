<?php

namespace Sfneal\CrudModelActions\Providers;

use Illuminate\Support\ServiceProvider;

class CrudModelActionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any CrudModelAction services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config file
        $this->publishes([
            __DIR__.'/../../config/crud-model-action.php' => config_path('crud-model-action.php'),
        ], 'config');
    }

    /**
     * Register any CrudModelAction services.
     *
     * @return void
     */
    public function register()
    {
        // Load config file
        $this->mergeConfigFrom(__DIR__.'/../../config/crud-model-action.php', 'crud-model-action');
    }
}
