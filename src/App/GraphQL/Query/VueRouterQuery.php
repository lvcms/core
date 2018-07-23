<?php

namespace Laracore\Core\App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

use Laracore\Core\App\Actions\VueRouterAction;

class VueRouterQuery extends Query
{
    protected $attributes = [
        'name' => 'VueRouterQuery',
        'description' => 'A Vue Router Query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('VueRouter'));
    }

    public function args()
    {
        return [
            'package' => ['name' => 'package', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        return app()->make(VueRouterAction::class)->handler();
    }
}
