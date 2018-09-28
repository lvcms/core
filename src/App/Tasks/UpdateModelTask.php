<?php

namespace Lvcmf\Core\App\Tasks;

use Lvcmf\Core\Framework\Contracts\Frontend\Model;

class UpdateModelTask
{
    public function handler()
    {
        return app()->make(Model::class)->update();
    }
}
