<?php

namespace Laracore\Core\Framework\Frontend;

use Laracore\Core\Framework\Contracts\Frontend\VueRouter as VueRouterContract;

class VueRouter implements VueRouterContract
{
    /**
     * 根据 model 获取对应 vueRouter
     *
     * @param  string  $model
     * @return mixed
     */
    public function get($model)
    {
        return config($model.'.vueRouter');
    }
}
