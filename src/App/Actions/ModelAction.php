<?php

namespace Laracore\Core\App\Actions;

use Cache;
use Laracore\Core\App\Tasks\GetModelLayoutTask;
use Laracore\Core\App\Tasks\ModelItemTask;
use Laracore\Core\App\Tasks\ModelLayoutTask;
use Illuminate\Support\Facades\Input;

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
        return [
            "layout" => $layout,
            "item" => $item,
            // "value" => $value
        ];
        // dd(Input::get('variables'));
        // // return Cache::remember(Input::get['variables.package'].":".Input::get['variables.model'], $this->minutes, function () use ($args) {
        // //     return app()->call(GetModelLayoutTask::class, [$args], 'run');
        // // });
        // $layout  = app()->call(GetModelLayoutTask::class, [$args], 'run');
        // $item = app()->call(GetModelItemTask::class, [$args], 'run');
        // $value = array_key_exists('item', $args)? app()->call(GetModelValueTask::class, [$args], 'run'): null;
        // return [
        //     "layout" => $layout,
        //     "item" => $item,
        //     "value" => $value
        // ];
    }
}
