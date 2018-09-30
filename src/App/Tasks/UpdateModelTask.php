<?php

namespace Lvcms\Core\App\Tasks;

use Lvcms\Core\Framework\Contracts\Frontend\Model;

class UpdateModelTask
{
    public function handler()
    {
        return app()->make(Model::class)->update();
    }
}
