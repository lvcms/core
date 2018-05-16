<?php

namespace Laracore\Core\Framework\Frontend;

use Laracore\Core\Framework\Contracts\Frontend\Model as ModelContract;

class Model implements ModelContract
{
    protected $package;
    protected $model;

    public function setPackage($package)
    {
        $this->package = $package;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function config()
    {
        return config($this->package.'.model.'.$this->model);
    }

    public function layout()
    {
        return $this->config()['layout'];
    }

    public function item()
    {
        return $this->config()['item'];
    }

    public function getItem()
    {
        return $this->config()['index'];
    }
}
