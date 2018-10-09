<?php

namespace Lvcms\Core\Framework\Frontend\Model;

use Illuminate\Support\Facades\Input;
use Lvcms\Core\App\Models\Upload;
use Lvcms\Core\Framework\Frontend\Model\Config;

class Item
{
    public $package;
    public $modelName;
    public $itemName;
    public $value;
    public $keyAlias;
    public $valueAlias;
    public $handlerFormRequest; // 自定义处理 form 提交数据方法名称
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
        $this->value = json_decode(Input::get('variables.value'));
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
            foreach ($this->itmeLayout as $key => $item) {
                if ($item['isValue']) {
                    switch ($item['modelType']) {
                        case 'key':
                            $value[$key] = $this->getKeyValue($key,$item);
                            break;
                        case 'id':
                            $value[$key] = $this->getIdValue();
                            break;
                    }
                }
            }
            return $value;
        }catch(\Exception $e){
            return $e;
        }
    }

    /**
     * [value 更新数据]
     * @return [type] [description]
     */
    public function update()
    {
        return $this->handlerFormRequest($this->value);
    }
    /**
     * [getIdValue 根据 id 获取 value]
     * @return [type]              [description]
     */
    public function getIdValue()
    {
        return $this->model->all();
    }
    /**
     * [getKeyValue 根据 key 获取 value]
     * @return [type]              [description]
     */
    public function getKeyValue($key,$item)
    {
        if ($query = $this->model->where($this->keyAlias, '=', $key)->first())
        {
            return $this->componentJsonTypeChange(
                $item['component'],
                $query->{$this->valueAlias}
            );# code...
        }else{
             abort(501, '数据库未找到配置项 '.$key.' 请修改 config 配置文件取消此配置项!');
        }
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
                try{
                    return [
                        'id' => (Float) $value,
                        'url' => $this->uploadModel->where('id', $value)->first()->url,
                    ];
                }catch(\Exception $e){
                    return $e;
                }
                break;
            case 'table':
                return json_decode($value);
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
    public function handlerFormRequest($value)
    {
        if (method_exists($this->model, $this->handlerFormRequest)) {
            // 自定义方法处理
            return $this->model->{$this->handlerFormRequest}($value);
        } else {
            if (empty($values->id)) {
                return $this->updateKeyValue($value);
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
    public function updateKeyValue($value)
    {
        try {
            foreach ($value as $key => $val) {
                $val = $this->upadteHeadHandler($key,$val);
                $this->model->where($this->keyAlias, '=', $key)->update([$this->valueAlias => $val]);
            }
        } catch (Exception $e) {
            abort(501, '数据更新失败');
        }
        return [
            'status' => 200,
            'message' => '数据更新成功',
            'value' => $value
        ];
    }
    /**
     * [upadteHeadHandler 更新前数据处理]
     */
    public function upadteHeadHandler($key,$value)
    {
        foreach ($this->itmeLayout as $name => $itme) {
            if ($key == $name) {
                switch ($itme['component']) {
                    case 'checkbox':
                        return json_encode($value);
                        break;
                    case 'select':
                        return json_encode($value);
                        break;
                    case 'upload':
                        return $value->id;
                        break;
                    default:
                        return $value;
                        break;
                }
            }
        }
    }
}
