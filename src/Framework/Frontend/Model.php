<?php

namespace Laracore\Core\Framework\Frontend;

use JWTAuth;
use Exception;
use Illuminate\Support\Facades\Input;

use Laracore\Core\Framework\Frontend\Model\Config;
use Laracore\Core\Framework\Contracts\Frontend\Model as ModelContract;
class Model implements ModelContract
{
    public $package;
    public $modelName;
    public $itemName;
    public $config;

    public function __construct(Config $configPro){
        $this->init();
        $this->config = $configPro->all();
    }
    /**
     * 初始化 input 数据源
     */
    public function init()
    {
        $this->package = Input::get('variables.package');
        $this->modelName = Input::get('variables.model');
        $this->itemName = Input::get('variables.item');
    }
    public function config()
    {
        return $this->config;
    }

    public function layout()
    {
        return $this->config->get('layout');
    }

    public function item()
    {
        return $this->config->get('item');
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
        if ($this->config->get('auth')) {
          try {
              return JWTAuth::parseToken()->authenticate() ? true : false;
          } catch (Exception $e) {
              return false;
          }
        }
        return true;
    }
}
