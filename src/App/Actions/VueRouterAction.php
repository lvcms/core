<?php

namespace Lvcmf\Core\App\Actions;

use Cache;
use Lvcmf\Core\App\Tasks\VueRouterTask;

class VueRouterAction
{
    /**
     * [protected 缓存时间]
     * @var [type]
     */
    protected $minutes = 120;

    public function handler()
    {
        return app()->make(VueRouterTask::class)->handler();
        // return Cache::remember('VueRouter:'.$args['package'], $this->minutes, function () use ($args) {
        //     return app()->call(GetVueRouterTask::class, [$args], 'run');
        // });
    }
}
