<?php

namespace Laracore\Core\App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

use Laracore\Core\App\Actions\ModelQueryAction;

class ModelQuery extends Query
{
    protected $attributes = [
        'name' => 'ModelQuery',
        'description' => 'A Model Query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::Type('Model'));
    }

    public function args()
    {
        return [
            'package' => ['name' => 'package', 'type' => Type::string()],
            'model' => ['name' => 'model', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        return app()->call(ModelQueryAction::class, [$args], 'run');
    }
}
