<?php

namespace Lvcms\Core\App\Tasks;

use Lvcms\Core\Framework\Contracts\Frontend\Model;

class ModelValueTask
{
    public function handler()
    {
        return app()->make(Model::class)->value();
    }
}
