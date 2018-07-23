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
    public function handler()
    {
        $item = app()->make(ModelItemTask::class)->handler();
        $layout  = app()->make(ModelLayoutTask::class)->handler();
        $value = app()->make(ModelValueTask::class)->handler();
        return [
            "layout" => $layout,
            "item" => $item,
            "value" => $value
        ];
    }
}
