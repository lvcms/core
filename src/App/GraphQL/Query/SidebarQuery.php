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
        'name' => 'SidebarQuery',
        'description' => 'A Sidebar Query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::Type('Sidebar'));
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
