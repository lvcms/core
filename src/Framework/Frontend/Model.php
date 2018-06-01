<?php

namespace Laracore\Core\Framework\Frontend;

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

    public function layout()
    {
        return $this->config()['layout'];
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
}
