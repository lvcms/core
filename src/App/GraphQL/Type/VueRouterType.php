<?php

namespace Laracore\Core\App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class VueRouterType extends BaseType
{
    protected $attributes = [
        'name' => 'VueRouterType',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [
            'path' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The path of the VueRouter'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of the VueRouter'
            ]
            ,
            'component' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The component of the VueRouter'
            ]
        ];
    }

    protected function resolveEmailField($root, $args)
    {
        return strtolower($root->email);
    }
}
