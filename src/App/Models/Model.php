<?php

namespace Laracore\Core\App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    protected $config;
    protected $item;
    protected $keyAlias;
    protected $valueAlias;

    /**
     * [setConfig 设置配置参数]
     * keyValueAlias 设置 keyAlias
     * keyValueAlias 设置 valueAlias
     * @param [type] $config [description]
     */
    public function setConfig($config)
    {
        $this->config = $config;
        $this->keyAlias = empty($this->config['keyValueAlias'])? 'key': $this->config['keyValueAlias']['key'];
        $this->valueAlias = empty($this->config['keyValueAlias'])? 'value': $this->config['keyValueAlias']['value'];
        return $this;
    }

    public function setItem($item)
    {
        $this->item = $item;
        return $this;
    }
    /**
     * [value 获取 value]
     * @return [type] [description]
     */
    public function value()
    {
        return $this->getKeyValue();
    }
    /**
     * [updateValue 更新数据]
     * @param  [type] $values [description]
     * @return [type]         [description]
     */
    public function updateValue($values)
    {
        if (empty($values->id)) {
            return $this->updateKeyValue($values);
        } else {
        }
    }
    /**
     * [updateKeyValue 更新 key 数据]
     * @param  [type] $values [description]
     * @return [type]         [description]
     */
    public function updateKeyValue($values)
    {
        try {
            foreach ($values as $key => $value) {
                if (is_array($value)) {
                    $value = json_encode($value);
                }
                $this->where($this->keyAlias, '=', $key)->update([$this->valueAlias => $value]);
            }
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
    /**
     * [getKeyValue 根据 key 获取 value]
     * @return [type]              [description]
     */
    public function getKeyValue()
    {
        $value = [];
        $valueAlias = $this->valueAlias;
        foreach ($this->item as $key => $item) {
            $value[$key] = $this->componentJsonTypeChange(
                $item['component'],
                $this->where($this->keyAlias, '=', $key)->first()->$valueAlias
            );
        }
        return $value;
    }
    /**
     * [componentJsonTypeChange 根据使用组件转换对应数据类型]
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
            case 'checkbox':
                return json_decode($value);
                break;
            case 'radio':
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
