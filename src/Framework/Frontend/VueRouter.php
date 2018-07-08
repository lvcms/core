<?php

namespace Laracore\Core\Framework\Frontend;

use Laracore\Core\Framework\Contracts\Frontend\VueRouter as VueRouterContract;

class VueRouter implements VueRouterContract
{
    protected $package;
    /**
     * 根据 package 获取对应 vueRouter
     *
     * @param  string  $package
     * @return mixed
     */
    public function get($package)
    {
        $this->package = $package;
        return $this->handler(
            $this->loadPackageConfig($this->config())
        );
    }
    /**
     * [handler 处理配置信息编译成前端路由]
     * @param  [type] $config [description]
     * @return [type]         [description]
     */
    public function handler($configs)
    {
        $vueRouter = collect($configs)->map(function ($config) {
            if (array_key_exists('originalChildren', $config)) {
                $config['children'] = array_merge($config['children'], $this->handlerModel($config['originalChildren']));
            }
            return $config;
        });
        return $vueRouter;
    }
    /**
     * [handlerModel 通过模块编译路由数据]
     * @param  [type] $original [description]
     * @return [type]           [description]
     */
    protected function handlerModel($original)
    {
        foreach ($original['model'] as $model) {
            $config = $this->modelConfig($model);
            $children[] = [
                'path'  =>  $config['path'],
                'name'  =>  $config['name'],
                'component' =>  $original['component']
            ];
        }
        return $this->loadPackageConfig($children);
    }
    /**
     * [config 获取配置]
     * @return [type]        [description]
     */
    protected function config()
    {
        return config($this->package.'.vueRouter');
    }
    /**
     * [modelConfig 模块配置]
     * @return [type] [description]
     */
    protected function modelConfig($model)
    {
        return config($this->package.'.model.'.$model);
    }

    /**
     * [loadPackageConfig 加载项目相关配置]
     * 增加模块 path 路径
     * 增加模块 name 前端路由别名增加模块识别
     * @return [type]        [description]
     */
    protected function loadPackageConfig($configs)
    {
        foreach ($configs as &$config) {
            $config['path'] = config($this->package.'.uri').'/'.$config['path'];
            $config['name'] = config($this->package.'.name').':'.$config['name'];
            if (array_key_exists('children', $config)) {
                $config['children'] = $this->loadPackageConfig($config['children']);
            }
        }
        return $configs;
    }
}
