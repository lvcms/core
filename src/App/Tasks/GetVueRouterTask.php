<?php

namespace Laracore\Core\App\Tasks;

use Laracore\Core\Framework\Contracts\Frontend\VueRouter;

class GetVueRouterTask
{
    public function run($args)
    {
        return app()->make(VueRouter::class)->get($args['package']);
    }
}
