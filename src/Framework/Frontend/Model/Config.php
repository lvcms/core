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
        $this->handlerItem();

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
     * 处理 item 渲染 handlerItem
     */
    public function handlerItem()
    {
        $item = $this->config->get('item');
        // 循环所有 item 项目
        foreach ($item as &$val) {
            // 循环每个项目下面的组件
            foreach ($val['item'] as &$component) {
                $component = $this->renderComponent($component);
            }
        }
        $this->config['item'] = $item;
    }
    /**
     * 渲染组件 renderComponent
     */
    private function renderComponent($component)
    {
        switch ($component['component']) {
            case 'upload':
                $configUpload = config('core.upload');
                // 根据上传文件样式 选择图片或者文件的上传格式限制
                $configUpload['format'] = $configUpload['format'][$component['fileType']];
                $component = array_merge($configUpload, $component);
                break;
            default:
                break;
        }
        return $component;
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
