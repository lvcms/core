<?php

namespace Lvcms\Core\Framework\Contracts\Frontend;

interface Model
{
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
     * [modal 获取模型 modal 弹出框布局]
     * @return [type] [description]
     */
    public function modal();

    /**
     * [item 获取模型 项目 item 项目布局]
     */
    public function item();
    /**
     * [value 获取数据]
     */
    public function value();
    /**
     * [update 更新数据]
     * @return [type]         [description]
     */
    public function update();
    /**
     * [authenticated 用户认证]
     * @return [type]         [description]
     */
    public function authenticated();
}
