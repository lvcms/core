<?php

namespace Laracore\Core\App\Actions;

use Laracore\Core\App\Tasks\UpdateModelTask;

class UpdateModelAction
{
    public function run($args)
    {
        if (app()->call(UpdateModelTask::class, [$args], 'run')) {
            return [
                'status' => 200,
                'message' => '数据更新成功',
                'value' => $args['value']
            ];
        } else {
            return [
                'status' => 500,
                'message' => '数据更新失败',
                'value' => $args['value']
            ];
        }
    }
}
