<?php

namespace Laracore\Core\App\Actions;

use Laracore\Core\App\Tasks\GetUploadTask;
class GetUploadAction
{
    public function run($key,$value)
    {
        return app()->call(GetUploadTask::class, [$key,$value], 'run');
    }
}
