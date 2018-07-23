<?php

namespace Laracore\Core\App\Actions;

use Laracore\Core\App\Tasks\UpdateModelTask;
class UpdateModelAction
{
    public function handle()
    {
        return app()->make(UpdateModelTask::class)->handle();
    }
}
