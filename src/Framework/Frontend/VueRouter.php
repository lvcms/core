<?php

namespace Lvcmf\Core\Framework\Frontend;

use Illuminate\Support\Facades\Input;
use Lvcmf\Core\Framework\Contracts\Frontend\VueRouter as VueRouterContract;

class VueRouter implements VueRouterContract
{
    protected $package;

    public function __construct(){
        $this->package = Input::get('variables.package');
    }
    /**
     * [handler 处理配置信息编译成前端路由]
     * @param  [type] $config [description]
     * @return [type]         [description]
     */
    public function handler()
    {
        $vueRouter = $this->loadPackageConfig($this->config())->map(function ($config) {
            if (array_key_exists('originalChildren', $config)) {
                // 处理模块数据
                $config['children'] = $this->handlerModel($config['originalChildren'])->merge($config['children']);
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
        return collect($configs);
    }
}
