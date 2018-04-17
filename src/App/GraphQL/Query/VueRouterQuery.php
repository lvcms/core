<?php

namespace Laracore\Core\App\GraphQL\Query;

use Laracore\Core\Framework\Contracts\Frontend\VueRouter;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

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
            'model' => ['name' => 'model', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
      $vueRouter = app()->make(VueRouter::class);
      return $vueRouter->get($args['model']);
    }
}
