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
        if (!$this->config['arrangement']['column']) {
            return $this->getKeyValue();
        }
    }
    /**
     * [getKeyValue 根据 key 获取value]
     * @param  [type] $arrangement [description]
     * @return [type]              [description]
     */
    public function getKeyValue()
    {
        $value = [];
        // 查询 Key 字段名
        $arrangementKey = $this->config['arrangement']['key'];
        // 查询 alue 字段名
        $arrangementValue = $this->config['arrangement']['value'];
        foreach ($this->item as $key => $item) {
            $value[$key] = $this->where($arrangementKey, '=', $key)->first()->$arrangementValue;
            // 如果为空显示默认值
            if (empty($value[$key])) {
                $value[$key] = $item['default'];
            }
        }
        return $value;
    }
}
