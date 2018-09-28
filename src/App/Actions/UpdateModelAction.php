<?php

namespace Lvcmf\Core\App\Actions;

use Lvcmf\Core\App\Tasks\UpdateModelTask;
class UpdateModelAction
{
    public function handler()
    {
        return app()->make(UpdateModelTask::class)->handler();
    }
}
