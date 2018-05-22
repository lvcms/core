<?php

namespace Laracore\Core\App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class UpdateModelType extends BaseType
{
    protected $attributes = [
        'name' => 'ModelType',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [
            'status' => [
                'type' => Type::string(),
                'description' => 'The status of the UpdateModel'
            ],
            'message' => [
                'type' => Type::string(),
                'description' => 'The message of the UpdateModel'
            ],
            'value' => [
                'type' => GraphQL::Type('CommonScalar'),
                'description' => 'The value of the UpdateModel'
            ]
        ];
    }
}
