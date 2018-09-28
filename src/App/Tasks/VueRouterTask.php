<?php

namespace Lvcmf\Core\App\Tasks;

use Lvcmf\Core\Framework\Contracts\Frontend\VueRouter;

class VueRouterTask
{
    public function handler()
    {
        return app()->make(VueRouter::class)->handler();
    }
}
