<?php

namespace Laracore\Core\Framework\Frontend;

use Laracore\Core\Framework\Contracts\Frontend\Model as ModelContract;

class Model implements ModelContract
{
    protected $package;
    protected $modelName;


    public function setPackage($package)
    {
        $this->package = $package;
    }

    public function setModel($model)
    {
        $this->modelName = $model;
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
        return $this->config()['model'];
    }

    public function value()
    {
        dd($this->model());
        return $this->config();
    }
}
