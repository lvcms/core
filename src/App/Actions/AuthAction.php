<?php

namespace Lvcms\Core\App\Actions;

use Lvcms\Core\App\Tasks\AuthTask;

class AuthAction
{
    public function handler()
    {
        return app()->make(AuthTask::class)->handler();
    }
}
