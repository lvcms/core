<?php

namespace Lvcmf\Core\Framework\Frontend;

use Illuminate\Support\Facades\Input;
use Lvcmf\Core\Framework\Contracts\Frontend\Sidebar as SidebarContract;

class Sidebar implements SidebarContract
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
        $configs = $this->config();
        foreach ($configs as &$config) {
            if (array_key_exists('model',$config)) {
                if (is_array($config['model'])) {
                    foreach ($config['model'] as $key => $model) {
                        $config['children'][$key] = $this->handlerModel($model);
                    }
                }else{
                    $config = $this->handlerModel($config['model']);
                }
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
            'name' => config($this->package.'.name').':'.$modelConfig['name'],//增加模块名称
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
        return config($this->package.'.sidebar');
    }
    /**
     * [modelConfig 模块配置]
     * @return [type] [description]
     */
    protected function modelConfig($model)
    {
        return config($this->package.'.model.'.$model);
    }
}
