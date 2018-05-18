<?php

namespace Laracore\Core\App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    protected $config;
    protected $item;

    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }

    public function setItem($item)
    {
        $this->item = $item;
        return $this;
    }

    public function value()
    {
        return $this->getKeyValue();
    }
    /**
     * [getKeyValue 根据 key 获取 value]
     * @return [type]              [description]
     */
    public function getKeyValue()
    {
        $value = [];
        $keyAlias = empty($this->config['keyValueAlias'])? 'key': $this->config['keyValueAlias']['key'];
        $valueAlias = empty($this->config['keyValueAlias'])? 'value': $this->config['keyValueAlias']['value'];
        foreach ($this->item as $key => $item) {
            $value[$key] = $this->where($keyAlias, '=', $key)->first()->$valueAlias;
        }
        return $value;
    }
}
