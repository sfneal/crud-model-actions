<?php


namespace Sfneal\CrudModelActions\Providers;


use Illuminate\Support\ServiceProvider;

class CrudModelActionServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Load config file
        $this->mergeConfigFrom(__DIR__.'/../config/crud-model-action.php', 'crud-model-action');
    }
}
