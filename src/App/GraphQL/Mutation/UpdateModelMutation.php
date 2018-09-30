<?php
namespace Lvcms\Core\App\GraphQL\Mutation;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

use Lvcms\Core\App\Actions\UpdateModelAction;
use Lvcms\Core\App\Actions\AuthAction;

class UpdateModelMutation extends Mutation
{
    protected $attributes = [
        'name' => 'UpdateModelMutation',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return Type::nonNull(GraphQL::Type('UpdateModel'));
    }

    public function args()
    {
        return [
            'package' => ['name' => 'package', 'type' => Type::nonNull(Type::string())],
            'model' => ['name' => 'model', 'type' => Type::nonNull(Type::string())],
            'value' => ['name' => 'value', 'type' => Type::nonNull(Type::string())],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        return app()->make(UpdateModelAction::class)->handler();
    }

    public function authenticated($root, $args, $context)
    {
        return app()->make(AuthAction::class)->handler();
    }

}
