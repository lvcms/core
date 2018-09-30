<?php

namespace Lvcms\Core\App\Tasks;

use Lvcms\Core\Framework\Contracts\Frontend\Model;

class ModelItemTask
{
    public function handler()
    {
        return app()->make(Model::class)->item();
    }
}
