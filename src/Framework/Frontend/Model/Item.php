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
    public $handlerFormRequest;
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
        $this->handlerFormRequest = $this->config->has('handlerFormRequest')?$this->config['handlerFormRequest']: null;

        $this->instantiation();
        /**
         * 防止没有传入项目名称 （一般获取布局时）报错
         */
        if($this->itemName){
            $this->itemLayout();
        }
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
        try{
            return $this->getKeyValue();
        }catch(\Exception $e){
            return;
        }
    }
        /**
     * [getKeyValue 根据 key 获取 value]
     * @return [type]              [description]
     */
    public function getKeyValue()
    {
        foreach ($this->itmeLayout as $key => $item) {
            if ($query = $this->model->where($this->keyAlias, '=', $key)->first()) {
                $value[$key] = $this->componentJsonTypeChange(
                    $item['component'],
                    $query->{$this->valueAlias}
                );# code...
            }else{
                abort(501, '数据库未找到配置项 '.$key.' 请修改 config 配置文件取消此配置项!');
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
    /**
     * [handlerFormRequest 更新数据]
     * @param  [type] $values [description]
     * @return [type]         [description]
     */
    public function handlerFormRequest($values)
    {
        if (method_exists($this, $this->handlerFormRequest)) {
            // 自定义方法处理
            return $this->{$this->handlerFormRequest}($values);
        } else {
            if (empty($values->id)) {
                return $this->updateKeyValue($values);
            } else {
                return '';
            }
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
            abort(501, '数据更新失败');
        }
        return [
            'status' => 200,
            'message' => '数据更新成功',
            'value' => $values
        ];
    }
}
