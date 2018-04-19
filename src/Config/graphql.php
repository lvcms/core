<?php
return [
    'schemas' => [
        'default' => [
            'query' => [
                'vueRouter' => Laracore\Core\App\GraphQL\Query\VueRouterQuery::class,
            ],
            'mutation' => [
                // 'updateUserPassword' =>  Laracore\Core\App\GraphQL\Mutation\UpdateUserPasswordMutation::class,
                // 'updateUserEmail' =>  Laracore\Core\App\GraphQL\Mutation\UpdateUserEmailMutation::class,
            ]
        ]
    ],

    'types' => [
        'CommonScalar' =>  Laracore\Core\App\GraphQL\Scalars\Common::class,
        'VueRouter' =>  Laracore\Core\App\GraphQL\Type\VueRouterType::class,
    ],
];
