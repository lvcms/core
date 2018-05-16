<?php

namespace Laracore\Core\Framework\Contracts\Frontend;

interface Model
{
    /**
     * [setPackage 设置扩展包]
     * @param [type] $package [description]
     */
    public function setPackage($package);
    /**
     * [setModel 设置操作模型]
     * @param [type] $model [description]
     */
    public function setModel($model);
    /**
     * [config  读取对应模型配置]
     * @return [type] [description]
     */
    public function config();
    /**
     * [layout 获取模型 Layout 布局]
     * @return [type] [description]
     */
    public function layout();
    /**
     * [item 获取模型 项目 layout 布局]
     */
    public function item();
    /**
     * [model 获取模型类]
     */
    public function model();
    /**
     * [value 获取数据]
     */
    public function value();
}
