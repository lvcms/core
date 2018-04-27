<?php

namespace Laracore\Core\App\Tasks;

use Laracore\Core\Framework\Contracts\Frontend\Sidebar;

class GetModelLayoutTask
{
    public function run($args)
    {
        return [$args];
    }
}
