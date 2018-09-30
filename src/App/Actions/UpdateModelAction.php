<?php

namespace Lvcms\Core\App\Actions;

use Lvcms\Core\App\Tasks\UpdateModelTask;
class UpdateModelAction
{
    public function handler()
    {
        return app()->make(UpdateModelTask::class)->handler();
    }
}
