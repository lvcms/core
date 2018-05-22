<?php

namespace Laracore\Core\App\Tasks;

use Laracore\Core\Framework\Contracts\Frontend\Model;

class UpdateModelTask
{
    public function run($args)
    {
        dd($args);
        // return [
        //     "layout" => null,
        //     "item" => null,
        //     "value" => $args['itemValue']
        //   ];
        // return app()->make(Model::class)
        //         ->setPackage($args['package'])
        //         ->setModel($args['model'])
        //         ->item();
    }
}
