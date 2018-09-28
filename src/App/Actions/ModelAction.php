<?php

namespace Lvcmf\Core\App\Actions;

use Cache;
use Illuminate\Support\Facades\Input;
use Lvcmf\Core\App\Tasks\ModelItemTask;
use Lvcmf\Core\App\Tasks\ModelLayoutTask;
use Lvcmf\Core\App\Tasks\ModelValueTask;

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
