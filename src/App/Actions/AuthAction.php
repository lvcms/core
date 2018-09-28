<?php

namespace Lvcmf\Core\App\Actions;

use Lvcmf\Core\App\Tasks\AuthTask;

class AuthAction
{
    public function handler()
    {
        return app()->make(AuthTask::class)->handler();
    }
}
