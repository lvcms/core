<?php

namespace Laracore\Core\App\Tasks;

use Laracore\Core\Framework\Contracts\Frontend\VueRouter;

class VueRouterTask
{
    public function handler()
    {
        return app()->make(VueRouter::class)->handler();
    }
}
