<?php

namespace Lvcms\Core\App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

use Lvcms\Core\App\Actions\ModelAction;
use Lvcms\Core\App\Actions\AuthAction;
class ModelQuery extends Query
{
    protected $attributes = [
        'name' => 'ModelQuery',
        'description' => 'A Model Query'
    ];

    public function type()
    {
        return Type::nonNull(GraphQL::Type('Model'));
    }

    public function args()
    {
        return [
            'package' => ['name' => 'package', 'type' => Type::nonNull(Type::string())],
            'model' => ['name' => 'model', 'type' => Type::nonNull(Type::string())],
            'item' => ['name' => 'item', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        return app()->make(ModelAction::class)->handler();
    }

    public function authenticated($root, $args, $context)
    {
        return app()->make(AuthAction::class)->handler();
    }
}
