<?php

namespace Laracore\Core\App\Tasks;

use Laracore\Core\Framework\Contracts\Frontend\Model;

class ModelItemTask
{
    public function handle()
    {
        return app()->make(Model::class)->item();
    }
}
