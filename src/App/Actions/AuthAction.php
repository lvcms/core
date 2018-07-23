<?php

namespace Laracore\Core\App\Actions;

use Laracore\Core\App\Tasks\AuthTask;

class AuthAction
{
    public function handler()
    {
        return app()->make(AuthTask::class)->handler();
    }
}
