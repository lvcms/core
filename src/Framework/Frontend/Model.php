<?php

namespace Laracore\Core\Framework\Frontend;

use JWTAuth;
use Exception;
use Laracore\Core\Framework\Contracts\Frontend\Model as ModelContract;

class Model implements ModelContract
{
    protected $package;
    protected $modelName;
    protected $itemName;


    public function setPackage($package)
    {
        $this->package = $package;
        return $this;
    }

    public function setModel($model)
    {
        $this->modelName = $model;
        return $this;
    }

    public function setItemName($itemName)
    {
        $this->itemName = $itemName;
        return $this;
    }

    public function config()
    {
        return config($this->package.'.model.'.$this->modelName);
    }
    
    public function configAuth()
    {
        return isset($this->config()['auth'])? $this->config()['auth']: true;
    }

    public function layout()
    {
        return $this->layoutDefalutConfig($this->config()['layout']);
    }
    /** 
     * 增加 layout 默认配置
     * 自动加载 layout col 配置
     * 自动加载 layout row 配置
     */
    private function layoutDefalutConfig($layouts)
    {
        foreach ($layouts as &$layout) {
           if (!array_key_exists('config', $layout)) {
               $layout['config'] = config($this->package.'.layout.'.$layout['style']);
           }
           if (array_key_exists('content', $layout)) {
                $layout['content'] = $this->layoutDefalutConfig($layout['content']);
           }
        }
        return $layouts;
    }

    public function item()
    {
        return $this->config()['item'];
    }

    public function model()
    {
        return app()->make($this->config()['model'])->setConfig($this->config());
    }

    public function value()
    {
        return $this->model()->setItem($this->item()[$this->itemName]['item'])->value();
    }

    public function update($values)
    {
        return $this->model()->handlerFormRequest($values);
    }

    public function authenticated()
    {
        if ($this->configAuth()) {
          try {
              return JWTAuth::parseToken()->authenticate() ? true : false;
          } catch (Exception $e) {
              return false;
          }
        }
        return true;
    }
}
