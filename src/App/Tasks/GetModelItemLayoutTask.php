<?php

namespace Laracore\Core\App\Tasks;

use Laracore\Core\Framework\Contracts\Frontend\Model;

class GetModelItemLayoutTask
{
    public function run($args)
    {
        $model = app()->make(Model::class);
        $model->setPackage($args['package']);
        $model->setModel($args['model']);
        return $model->itemLayout();
    }
}
