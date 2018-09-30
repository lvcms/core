<?php

namespace Lvcms\Core\App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class SidebarType extends BaseType
{
    protected $attributes = [
        'name' => 'SidebarType',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The title of the Sidebar'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the Sidebar'
            ],
            'icon' => [
                'type' => Type::string(),
                'description' => 'The icon of the Sidebar'
            ],
            'children' => [
                'type' => GraphQL::Type('CommonScalar'),
                'description' => 'The children of the Sidebar'
            ]

        ];
    }
}
