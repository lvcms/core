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
        //发布视图
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/core'),
        ]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->initConfig();
    }

    /**
     * [initConfig 初始化常用配置]
     * @return [type] [description]
     */
    public function initConfig()
    {
        //设置user模型位置
        config(['auth.providers.users.model' => App\Models\User::class]);
    }
}
