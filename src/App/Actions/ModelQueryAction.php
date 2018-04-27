<?php

namespace Laracore\Core\App\Actions;

use Cache;
use Laracore\Core\App\Tasks\GetModelLayoutTask;

class ModelQueryAction
{
    /**
     * [protected 缓存时间]
     * @var [type]
     */
    protected $minutes = 120;

    public function run($args)
    {
        $layout  = app()->call(GetModelLayoutTask::class, [$args], 'run');
        // $layout  = Cache::remember($args['package'].":".$args['model'], $this->minutes, function () use ($args) {
        //     return app()->call(GetModelLayoutTask::class, [$args], 'run');
        // });
        $data = 6;
        return [[
            "layout" => $layout,
            "data" => $data
          ]];
    }
}
