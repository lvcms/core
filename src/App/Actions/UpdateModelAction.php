<?php

namespace Laracore\Core\App\Actions;

use Laracore\Core\App\Tasks\UpdateModelTask;

class UpdateModelAction
{
    public function run($args)
    {
        return app()->call(UpdateModelTask::class, [$args], 'run');
    }
}
