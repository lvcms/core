<?php

namespace Laracore\Core\App\Actions;

use Cache;
use Laracore\Core\App\Tasks\GetModelLayoutTask;
use Laracore\Core\App\Tasks\GetModelItemTask;

class ModelQueryAction
{
    /**
     * [protected 缓存时间]
     * @var [type]
     */
    protected $minutes = 120;

    public function run($args)
    {

      // return Cache::remember($args['package'].":".$args['model'], $this->minutes, function () use ($args) {
        //     return app()->call(GetModelLayoutTask::class, [$args], 'run');
        // });
        $layout  = app()->call(GetModelLayoutTask::class, [$args], 'run');
        $item = app()->call(GetModelItemTask::class, [$args], 'run');
        return [[
            "layout" => $layout,
            "item" => $item
          ]];
    }
}
