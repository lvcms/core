<?php

namespace Laracore\Core\App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class ModelType extends BaseType
{
    protected $attributes = [
        'name' => 'ModelType',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [
            'layout' => [
                'type' => GraphQL::Type('CommonScalar'),
                'description' => 'The layout of the Model'
            ],
            'item' => [
                'type' => GraphQL::Type('CommonScalar'),
                'description' => 'The data of the item'
            ],
            'value' => [
                'type' => GraphQL::Type('CommonScalar'),
                'description' => 'The data of the value'
            ]
        ];
    }
}
