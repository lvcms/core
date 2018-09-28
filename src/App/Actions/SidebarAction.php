<?php

namespace Lvcmf\Core\App\Actions;

use Cache;
use Lvcmf\Core\App\Tasks\SidebarTask;

class SidebarAction
{
    /**
     * [protected 缓存时间]
     * @var [type]
     */
    protected $minutes = 120;

    public function handler()
    {
        return app()->make(SidebarTask::class)->handler();
        // return Cache::remember('Sidebar:'.$args['package'], $this->minutes, function () use ($args) {
        //     return app()->call(GetSidebarTask::class, [$args], 'run');
        // });
    }
}
