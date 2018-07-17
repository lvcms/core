<?php

namespace Laracore\Core\Framework\Frontend\Model;

use Illuminate\Support\Facades\Input;
use Laracore\Core\App\Models\Upload;
use Laracore\Core\Framework\Frontend\Model\Config;

class Item
{
    public $package;
    public $modelName;
    public $itemName;
    public $keyAlias;
    public $valueAlias;
    public $uploadModel;
    public $config;
    public $model; //实例化对应模型
    public $itmeLayout;

    public function __construct(Config $configPro, Upload $uploadPro)
    {
        $this->uploadModel = $uploadPro;
        $this->config = $configPro->all();
        $this->init();
    }
    /**
     * 初始化数据
     */
    public function init()
    {
        $this->package = Input::get('variables.package');
        $this->modelName = Input::get('variables.model');
        $this->itemName = Input::get('variables.item');
        $this->keyAlias = $this->config->has('key')? $this->config['keyValueAlias']['key']: 'key';
        $this->valueAlias = $this->config->has('value')? $this->config['keyValueAlias']['value']: 'value';

        $this->instantiation();
        $this->itemLayout();
    }
    /**
     * 实例化 model 模型
     */
    public function instantiation()
    {
        $this->model = app()->make($this->config->get('model'));
    }
    /**
     * 项目布局 itemLayout
     */
    public function itemLayout()
    {
        $this->itmeLayout = $this->config->get('item')[$this->itemName]['item'];
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
     * [getKeyValue 根据 key 获取 value]
     * @return [type]              [description]
     */
    public function getKeyValue()
    {
        $value = [];
        $valueAlias = $this->valueAlias;
        foreach ($this->itmeLayout as $key => $item) {
            if ($query = $this->model->where($this->keyAlias, '=', $key)->first()) {
                $value[$key] = $this->componentJsonTypeChange(
                    $item['component'],
                    $query->$valueAlias
                );# code...
            }else{
                abort(501, '数据库未找到配置项 '.$key.' 请检查迁移文件是否配置');
            }
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
            case 'select':
                return json_decode($value)? json_decode($value): $value;
                break;
            case 'radio':
                return is_numeric($value)? (Float)$value: (String)$value;
                break;
            case 'switch':
                return (Boolean)$value;
                break;
            case 'upload':
                return [
                    'id' => (Float)$value,
                    'url' => $this->uploadModel->where('id', $value)->first()->url
                ];
                break;
            default:
                return $value;
                break;
        }
    }

}
