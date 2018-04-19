<?php

namespace Laracore\Core\App\Tasks;

use Laracore\Core\Framework\Contracts\Frontend\Sidebar;

class GetSidebarTask
{
    public function run($args)
    {
        return app()->make(Sidebar::class)->get($args['model']);
    }
}
