<?php

namespace Lvcms\Core\App\GraphQL\Type;

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
                'type' => GraphQL::Type('CommonScalar'),
                'description' => 'The component of the VueRouter'
            ],
            'children' => [
                'type' => GraphQL::Type('CommonScalar'),
                'description' => 'The children of the VueRouter'
            ]

        ];
    }
}
