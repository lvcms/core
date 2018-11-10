<?php

namespace Lvcms\Core\App\Tasks;

use Lvcms\Core\Framework\Contracts\Frontend\Model;

class ModelModalTask
{
    public function handler()
    {
        return app()->make(Model::class)->modal();
    }
}
