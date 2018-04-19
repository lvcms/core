<?php

namespace Laracore\Core\Framework\Frontend;

use Laracore\Core\Framework\Contracts\Frontend\Sidebar as SidebarContract;

class Sidebar implements SidebarContract
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
        return $this->handler($this->config());
    }
    /**
     * [handler 处理配置信息编译成前端路由]
     * @param  [type] $config [description]
     * @return [type]         [description]
     */
    public function handler($configs)
    {
        foreach ($configs as $key => $config) {
            $sidebar[] = [
              'title' => $key,
              'children' => $this->handlerModel($config)
            ];
        }
        return $sidebar;
    }
    /**
     * [handlerModel 通过模块编译路由数据]
     * @param  [type] $original [description]
     * @return [type]           [description]
     */
    protected function handlerModel($config)
    {
        foreach ($config as $model) {
            $modelConfig = $this->modelConfig($model);
            $sidebar[] = [
              'title' => $modelConfig['title'],
              'path' => $modelConfig['path'],
            ];
        }
        return $sidebar;
    }
    /**
     * [config 获取配置]
     * @param  [type] $model [description]
     * @return [type]        [description]
     */
    protected function config()
    {
        return config($this->model.'.sidebar');
    }
    /**
     * [modelConfig 模块配置]
     * @return [type] [description]
     */
    protected function modelConfig($model)
    {
        return config($this->model.'.model.'.$model);
    }
}
