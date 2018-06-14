<?php
return [
    'schemas' => [
        'default' => [
            'query' => [
                'vueRouter' => Laracore\Core\App\GraphQL\Query\VueRouterQuery::class,
                'sidebar' => Laracore\Core\App\GraphQL\Query\SidebarQuery::class,
                'model' => Laracore\Core\App\GraphQL\Query\ModelQuery::class,
            ],
            'mutation' => [
                'updateModel' =>  Laracore\Core\App\GraphQL\Mutation\UpdateModelMutation::class,
            ]
        ]
    ],

    'types' => [
        'CommonScalar' =>  Laracore\Core\App\GraphQL\Scalars\Common::class,
        'VueRouter' =>  Laracore\Core\App\GraphQL\Type\VueRouterType::class,
        'Sidebar' =>  Laracore\Core\App\GraphQL\Type\SidebarType::class,
        'Model' =>  Laracore\Core\App\GraphQL\Type\ModelType::class,
        'UpdateModel' =>  Laracore\Core\App\GraphQL\Type\UpdateModelType::class,
    ],
];
