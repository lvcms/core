<?php

namespace Laracore\Core\App\Tasks;

use Laracore\Core\Framework\Contracts\Frontend\Model;

class ModelValueTask
{
    public function handle()
    {
        return app()->make(Model::class)->value();
    }
}
