<?php
return [
    'schemas' => [
        'default' => [
            'query' => [
                'users' => Laracore\Core\App\GraphQL\Query\UserQuery::class,

                'vueRouter' => Laracore\Core\App\GraphQL\Query\VueRouterQuery::class,
            ],
            'mutation' => [
                // 'updateUserPassword' =>  Laracore\Core\App\GraphQL\Mutation\UpdateUserPasswordMutation::class,
                // 'updateUserEmail' =>  Laracore\Core\App\GraphQL\Mutation\UpdateUserEmailMutation::class,
            ]
        ]
    ],

    'types' => [
        'User' =>  Laracore\Core\App\GraphQL\Type\UserType::class,

        'CommonScalar' =>  Laracore\Core\App\GraphQL\Scalars\Common::class,
        'VueRouter' =>  Laracore\Core\App\GraphQL\Type\VueRouterType::class,
    ],
];
