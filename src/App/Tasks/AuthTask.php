<?php

namespace Laracore\Core\App\Tasks;

use Laracore\Core\Framework\Contracts\Frontend\Model;

class AuthTask
{
    public function run($args)
    {
        return app()->make(Model::class)
                ->setPackage($args['package'])
                ->setModel($args['model'])
                ->authenticated();
    }
}