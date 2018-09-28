<?php

namespace Lvcmf\Core\App\Tasks;

use Lvcmf\Core\Framework\Contracts\Frontend\Model;

class ModelValueTask
{
    public function handler()
    {
        return app()->make(Model::class)->value();
    }
}
