<?php

namespace Abedin\Maker\Providers;

use Abedin\Maker\Commands\MakeModel;
use Abedin\Maker\Commands\MakeRepository;
use Illuminate\Support\ServiceProvider;
use Abedin\Maker\Lib\Managers\PushManager;
use Abedin\Maker\Lib\Managers\SetPurchaseKey;

class MakerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerNewModelCommand();
        $this->registerNewRepositoryCommand();
    }

    public function boot()
    {
        PushManager::push();
        SetPurchaseKey::set();
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
