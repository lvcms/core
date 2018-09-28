<?php

namespace Lvcmf\Core\App\Tasks;

use Lvcmf\Core\Framework\Contracts\Frontend\Model;

class AuthTask
{
    public function handler()
    {
        return app()->make(Model::class)->authenticated();
    }
}
