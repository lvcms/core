<?php

namespace Lvcmf\Core\App\Tasks;

use Lvcmf\Core\Framework\Contracts\Frontend\Sidebar;

class SidebarTask
{
    public function handler()
    {
        return app()->make(Sidebar::class)->handler();
    }
}
