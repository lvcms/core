<?php

namespace Laracore\Core\App\Actions;

use Cache;
use Laracore\Core\App\Tasks\GetVueRouterTask;

class VueRouterAction
{
    /**
     * [protected 缓存时间]
     * @var [type]
     */
    protected $cacheMinutes = 120;

    public function run($args)
    {
        return Cache::remember('VueRouter:'.$args['model'], $cacheMinutes, function () use ($args) {
            return app()->call(GetVueRouterTask::class, [$args], 'run');
        });
    }
}
