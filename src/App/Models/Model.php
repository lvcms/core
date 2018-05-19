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
            $value[$key] = $this->componentJsonTypeChange(
                $item['component'],
                $this->where($keyAlias, '=', $key)->first()->$valueAlias
            );
        }
        return $value;
    }
    /**
     * [componentJsonTypeChange 根据使用自检转换对应数据类型]
     * @param  [type] $component [组件名称]
     * @param  [type] $value     [原始数据]
     * @return [type]            [description]
     */
    public function componentJsonTypeChange($component, $value)
    {
        switch ($component) {
            case 'input':
                return is_numeric($value)? (Float)$value: (String)$value;
                break;
            case 'switch':
                return (Boolean)$value;
                break;
            default:
                return $value;
                break;
        }
    }
}
