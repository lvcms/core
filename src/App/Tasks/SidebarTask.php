<?php

namespace Lvcms\Core\App\Tasks;

use Lvcms\Core\Framework\Contracts\Frontend\Sidebar;

class SidebarTask
{
    public function handler()
    {
        return app()->make(Sidebar::class)->handler();
    }
}
