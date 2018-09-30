<?php

namespace Lvcms\Core\App\Tasks;

use Lvcms\Core\Framework\Contracts\Frontend\VueRouter;

class VueRouterTask
{
    public function handler()
    {
        return app()->make(VueRouter::class)->handler();
    }
}
