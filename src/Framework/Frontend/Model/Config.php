<?php

namespace Laracore\Core\Framework\Frontend\Model;

use Illuminate\Support\Facades\Input;

class Config
{
    public $package;
    public $modelName;
    public $itemName;
    public $config;

    public function __construct(){
        $this->package = Input::get('variables.package');
        $this->modelName = Input::get('variables.model');
        $this->itemName = Input::get('variables.item');
        $this->init();
    }
    /**
     * 初始化
     */
    public function init(){
        $this->config = collect(config($this->package.'.model.'.$this->modelName));
        $this->config['layout'] = $this->layout();
        $this->config['auth'] = $this->auth();
    }
    /** 
     * 获取全部配置
     */
    public function all(){
        return $this->config;
    }
    /**
     * 获取 Auth 配置
     */
    public function auth()
    {
        return $this->config->has('auth')? $this->config->get('auth'): true;
    }
    /**
     * 获取 layout 默认配置
     */
    public function layout()
    {
        return $this->layoutDefalutConfig($this->config->get('layout'));
    }

    /** 
     * 增加 layout 默认配置
     * 自动加载 layout col 配置
     * 自动加载 layout row 配置
     */
    private function layoutDefalutConfig($layouts)
    {
        foreach ($layouts as &$layout) {
            //没有自定义配置时加载默认配置 仅支持 col row 设定其他 style 会报错
           if (!array_key_exists('config', $layout)) {
               $layout['config'] = config('core.layout.'.$layout['style']);
           }
           if (array_key_exists('content', $layout)) {
                $layout['content'] = $this->layoutDefalutConfig($layout['content']);
           }
        }
        return $layouts;
    }
}
