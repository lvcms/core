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
        foreach ($configs as &$config) {
            if (is_array($config['model'])) {
                foreach ($config['model'] as $key => $model) {
                  $config['children'][$key] = $this->handlerModel($model);
                }
            }else{
                $config = $this->handlerModel($config['model']);
            }
        }
        return $configs;
    }
    /**
     * [handlerModel 通过模块编译菜单数据]
     * @param  [type] $original [description]
     * @return [type]           [description]
     */
    protected function handlerModel($model)
    {
        $modelConfig = $this->modelConfig($model);
        return [
            'title' => $modelConfig['title'],
            'name' => $modelConfig['name'],
            'icon' => array_key_exists('icon', $modelConfig)? $modelConfig['icon']: null,
        ];
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
