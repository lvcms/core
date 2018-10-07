<?php

namespace Lvcms\Core;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Illuminate\Contracts\Http\Kernel;
use Lvcms\Core\App\Http\Middleware\Cors;
use Lvcms\Core\Framework\Contracts\Frontend\VueRouter as VueRouterContract;
use Lvcms\Core\Framework\Frontend\VueRouter;
use Lvcms\Core\Framework\Contracts\Frontend\Sidebar as SidebarContract;
use Lvcms\Core\Framework\Frontend\Sidebar;
use Lvcms\Core\Framework\Contracts\Frontend\Model as ModelContract;
use Lvcms\Core\Framework\Frontend\Model;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        //加载artisan commands
        $this->commands([
            \Lvcms\Core\App\Console\InstallCommand::class,
            \Lvcms\Core\App\Console\UninstallCommand::class,
        ]);
        //迁移文件配置
        $this->loadMigrationsFrom(__DIR__.'/Databases/migrations');
        //配置路由
        $this->loadRoutesFrom(__DIR__.'/Routes/api.php');
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        //视图
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'core');
        // 发布配置文件
        $this->publishes([
            __DIR__.'/Config/core.php' => config_path('core.php'),
            __DIR__.'/Config/graphql.php' => config_path('graphql.php'),
        ], 'core:config');
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
        // 注册中间件
        app()->make(Kernel::class)->prependMiddleware(Cors::class);
        $this->initConfig();
        $this->bind();
    }

    /**
     * [initConfig 初始化常用配置]
     * @return [type] [description]
     */
    public function initConfig()
    {
        //设置 user 模型位置
        config(['auth.providers.users.model' => App\Models\User::class]);
    }
    /**
     * [bind 绑定实例]
     */
    public function bind()
    {
        $this->app->bind(VueRouterContract::class, VueRouter::class);
        $this->app->bind(SidebarContract::class, Sidebar::class);
        $this->app->bind(ModelContract::class, Model::class);
    }
}
