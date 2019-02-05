<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Analogue;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->app->make('analogue');
        Analogue::registerPlugin('Analogue\ORM\Plugins\Timestamps\TimestampsPlugin');
        Analogue::registerPlugin('Analogue\ORM\Plugins\SoftDeletes\SoftDeletesPlugin');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('App\ApplicationLayer\Accounts\Interfaces\IAccountMainService', 'App\ApplicationLayer\Accounts\AccountMainService');
        $this->app->bind('App\ApplicationLayer\Items\Interfaces\IItemMainService', 'App\ApplicationLayer\Items\ItemMainService');
        

        $this->app->bind('App\DomainModelLayer\Accounts\Repositories\IAccountMainRepository', 'App\Infrastructure\Accounts\AccountMainRepository');
        $this->app->bind('App\DomainModelLayer\Items\Repositories\IItemMainRepository', 'App\Infrastructure\Items\ItemMainRepository');
    }
}
