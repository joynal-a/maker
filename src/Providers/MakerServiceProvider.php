<?php

namespace Abedin\Maker\Providers;

use Abedin\Maker\Commands\MakeModel;
use Abedin\Maker\Commands\MakeRepository;
use Illuminate\Support\ServiceProvider;
use Joynala\Maker\Lib\Managers\PushManager;

class MakerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        $this->registerNewModelCommand();
        $this->registerNewRepositoryCommand();
    }

    public function boot()
    {
        PushManager::push();
    }

    protected function registerNewModelCommand(): void
    {
        $this->app->bind('command.make:model', MakeModel::class);
        $this->commands(['command.make:model']);
    }

    protected function registerNewRepositoryCommand(): void
    {
        $this->app->bind('command.make:repository', MakeRepository::class);
        $this->commands(['command.make:repository']);
    }
}
