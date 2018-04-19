<?php

namespace Laracore\Core\Framework\Frontend;

use Laracore\Core\Framework\Contracts\Frontend\VueRouter as VueRouterContract;

class VueRouter implements VueRouterContract
{
    protected $model;
    /**
     * 根据 model 获取对应 vueRouter
     *
     * @param  string  $model
     * @return mixed
     */
    public function get($model)
    {
        $this->model = $model;

        $configs = $this->config();
        return $this->handler($configs);
    }
    /**
     * [handler 处理配置信息编译成前端路由]
     * @param  [type] $config [description]
     * @return [type]         [description]
     */
    public function handler($configs)
    {
        $vueRouter = collect($configs)->map(function ($config) {
            if (!empty($config['originalChildren'])) {
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
    public function handlerModel($original)
    {
        foreach ($original['model'] as $model) {
            $config = $this->modelConfig($model);
            $vueRouter[] = [
                'path'  =>  $config['path'],
                'name'  =>  $config['name'],
                'component' =>  $original['component']
            ];
        }
        return $vueRouter;
    }
    /**
     * [config 获取配置]
     * @param  [type] $model [description]
     * @return [type]        [description]
     */
    public function config()
    {
        return config($this->model.'.vueRouter');
    }
    /**
     * [modelConfig 模块配置]
     * @return [type] [description]
     */
    public function modelConfig($model)
    {
        return config($this->model.'.model.'.$model);
    }
}
