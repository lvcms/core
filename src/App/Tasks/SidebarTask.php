<?php

namespace Laracore\Core\App\Tasks;

use Laracore\Core\Framework\Contracts\Frontend\Sidebar;

class SidebarTask
{
    public function handler()
    {
        return app()->make(Sidebar::class)->handler();
    }
}
