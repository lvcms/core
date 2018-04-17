<?php

namespace Laracore\Core;

use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        //配置路由
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        //视图
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'core');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
