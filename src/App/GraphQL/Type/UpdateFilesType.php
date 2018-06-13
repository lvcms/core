<?php

namespace Laracore\Core\App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class UpdateFilesType extends BaseType
{
    protected $attributes = [
        'name' => 'ModelType',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::string(),
                'description' => 'The status of the id'
            ],
            'uid' => [
                'type' => Type::string(),
                'description' => 'The message of the userId'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The value of the name'
            ],
            'path' => [
                'type' => Type::string(),
                'description' => 'The value of the path'
            ],
            'extension' => [
                'type' => Type::string(),
                'description' => 'The value of the extension'
            ],
            'size' => [
                'type' => Type::string(),
                'description' => 'The value of the size'
            ],
            'md5' => [
                'type' => Type::string(),
                'description' => 'The value of the md5'
            ],
            'sha1' => [
                'type' => Type::string(),
                'description' => 'The value of the sha1'
            ],
            'disk' => [
                'type' => Type::string(),
                'description' => 'The value of the disk'
            ],
            'download' => [
                'type' => Type::string(),
                'description' => 'The value of the download'
            ],
            'status' => [
                'type' => Type::string(),
                'description' => 'The value of the status'
            ],
            'sort' => [
                'type' => Type::string(),
                'description' => 'The value of the sort'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The value of the created_at'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'The value of the updated_at'
            ]
        ];
    }
}
