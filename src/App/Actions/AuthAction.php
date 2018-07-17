<?php

namespace Laracore\Core\App\Actions;

use Laracore\Core\App\Tasks\AuthTask;

class AuthAction
{
    public function handle()
    {
        return app()->make(AuthTask::class)->handle();
    }
}
