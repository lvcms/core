<?php

namespace Laracore\Core\App\Tasks;

use Laracore\Core\Framework\Contracts\Frontend\Model;

class UpdateModelTask
{
    public function run($args)
    {
        return app()->make(Model::class)
                ->setPackage($args['package'])
                ->setModel($args['model'])
                ->update($args['value']);
    }
}
