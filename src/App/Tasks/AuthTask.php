<?php

namespace Laracore\Core\App\Tasks;

use Laracore\Core\Framework\Contracts\Frontend\Model;

class AuthTask
{
    public function handler()
    {
        return app()->make(Model::class)->authenticated();
    }
}
