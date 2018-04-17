<?php
return [
    'schemas' => [
        'default' => [
            'query' => [
                'users' => Laracore\Core\App\GraphQL\Query\UserQuery::class,
            ],
            'mutation' => [
                'updateUserPassword' =>  Laracore\Core\App\GraphQL\Mutation\UpdateUserPasswordMutation::class,
                'updateUserEmail' =>  Laracore\Core\App\GraphQL\Mutation\UpdateUserEmailMutation::class,
            ]
        ]
    ],

    'types' => [
        'User' =>  Laracore\Core\App\GraphQL\Type\UserType::class,
    ],
];
