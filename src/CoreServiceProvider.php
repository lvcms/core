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
        $this->mergeConfigFrom(
                  __DIR__.'/Config/graphql.php',
                  'coreGraphql'
            );
        //设置 user 模型位置
        config(['auth.providers.users.model' => App\Models\User::class]);
        // GraphQL 配置
        config(['graphql.types' => array_merge(config('graphql.types'), config('coreGraphql.types')) ]);
        config(['graphql.schemas.default.query' => array_merge(config('graphql.schemas.default.query'), config('coreGraphql.schemas.default.query'))]);
        // config(['graphql.schemas.default.mutation.updateUserPassword' => App\GraphQL\Mutation\UpdateUserPasswordMutation::class]);
    }
}
