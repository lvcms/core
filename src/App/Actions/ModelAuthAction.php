<?php

namespace Laracore\Core\App\Actions;

use Laracore\Core\App\Tasks\ModelAuthTask;

class ModelAuthAction
{
    /**
     * [protected 缓存时间]
     * @var [type]
     */
    protected $minutes = 120;

    public function run($args)
    {
        return app()->call(ModelAuthTask::class, [$args], 'run');
    }
}
