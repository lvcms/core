<?php

namespace Laracore\Core\App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

use Laracore\Core\App\Actions\SidebarAction;

class SidebarQuery extends Query
{
    protected $attributes = [
        'name' => 'VueRouterQuery',
        'description' => 'A Vue Router Query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::Type('CommonScalar'));
    }

    public function args()
    {
        return [
            'model' => ['name' => 'model', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        return app()->call(SidebarAction::class, [$args], 'run');
    }
}
