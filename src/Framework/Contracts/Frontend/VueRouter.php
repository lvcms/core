<?php

namespace Lvcmf\Core\Framework\Contracts\Frontend;

interface VueRouter
{
    /**
     * 根据 model 获取对应 vueRouter
     *
     * @param  string  $model
     * @return mixed
     */
    public function handler();

}
