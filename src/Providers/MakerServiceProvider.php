<?php

namespace Abedin\Boiler\Providers;

use Abedin\Boiler\Commands\MakeModel;
use Illuminate\Support\ServiceProvider;

class MakerServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerNewModelCommand();
    }

    protected function registerNewModelCommand(): void
    {
        $this->app->bind('command.make:model', MakeModel::class);
        $this->commands(['command.make:model']);
    }
}