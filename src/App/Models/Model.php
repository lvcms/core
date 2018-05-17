<?php

namespace Laracore\Core\App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    protected $config;

    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }

    public function value()
    {
        return $this->config;
    }
}
