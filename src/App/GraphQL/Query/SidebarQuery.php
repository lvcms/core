<?php

namespace Lvcmf\Core\App\GraphQL\Query;

use JWTAuth;
use GraphQL;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Lvcmf\Core\App\Actions\SidebarAction;

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
            'package' => ['name' => 'package', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        return app()->make(SidebarAction::class)->handler();
    }
}
