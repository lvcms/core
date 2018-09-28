<?php

namespace Lvcmf\Core\App\Tasks;

use Lvcmf\Core\Framework\Contracts\Frontend\Model;

class ModelItemTask
{
    public function handler()
    {
        return app()->make(Model::class)->item();
    }
}
