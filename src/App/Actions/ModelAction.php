<?php

namespace Lvcms\Core\App\Actions;

use Cache;
use Illuminate\Support\Facades\Input;
use Lvcms\Core\App\Tasks\ModelItemTask;
use Lvcms\Core\App\Tasks\ModelLayoutTask;
use Lvcms\Core\App\Tasks\ModelModalTask;
use Lvcms\Core\App\Tasks\ModelValueTask;

class ModelAction
{
    /**
     * [protected 缓存时间]
     * @var [type]
     */
    protected $minutes = 120;
    public function handler()
    {
        $layout  = app()->make(ModelLayoutTask::class)->handler();
        $modal = app()->make(ModelModalTask::class)->handler();
        $item = app()->make(ModelItemTask::class)->handler();
        $value = app()->make(ModelValueTask::class)->handler();
        return [
            "layout" => $layout,
            "modal" => $modal,
            "item" => $item,
            "value" => $value
        ];
    }
}
