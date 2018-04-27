<?php

namespace Laracore\Core\App\Actions;

use Cache;
use Laracore\Core\App\Tasks\GetSidebarTask;

class SidebarAction
{
    /**
     * [protected 缓存时间]
     * @var [type]
     */
    protected $minutes = 120;

    public function run($args)
    {
        return app()->call(GetSidebarTask::class, [$args], 'run');
        // return Cache::remember('Sidebar:'.$args['package'], $this->minutes, function () use ($args) {
        //     return app()->call(GetSidebarTask::class, [$args], 'run');
        // });
    }
}
