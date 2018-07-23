<?php

namespace Laracore\Core\App\Actions;

use Laracore\Core\App\Tasks\UpdateModelTask;
class UpdateModelAction
{
    public function handler()
    {
        return app()->make(UpdateModelTask::class)->handler();
    }
}
