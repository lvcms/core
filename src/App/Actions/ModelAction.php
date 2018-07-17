<?php

namespace Laracore\Core\App\Actions;

use Cache;
use Illuminate\Support\Facades\Input;
use Laracore\Core\App\Tasks\ModelItemTask;
use Laracore\Core\App\Tasks\ModelLayoutTask;
use Laracore\Core\App\Tasks\ModelValueTask;

class ModelAction
{
    /**
     * [protected 缓存时间]
     * @var [type]
     */
    protected $minutes = 120;
    public function handle()
    {
        $item = app()->make(ModelItemTask::class)->handle();
        $layout  = app()->make(ModelLayoutTask::class)->handle();
        $value = app()->make(ModelValueTask::class)->handle();
        return [
            "layout" => $layout,
            "item" => $item,
            "value" => $value
        ];
    }
}
