<?php

namespace Users;

use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [

    // 'controllers' => [
    //     'factories' => [
    //         Controller\UsersController::class => InvokableFactory::class,
    //     ],
    // ],

    // The following section is new and should be added to your file:
    'router' => [
        'users' => [
            'type'    => Segment::class,
            'options' => [
                'route' => '/users[/:action[/:id]]',
                'constraints' => [
                    'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    'id'     => '[0-9]+',
                ],
                'defaults' => [
                    'controller' => Controller\UsersController::class,
                    'action'     => 'index',
                ],
            ],
        ],
        'routes' => [
            'register' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/register',
                    'defaults' => [
                        'controller' => Controller\UsersController::class,
                        'action'     => 'register',
                    ],
                ],
            ],
            'connect' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/connect',
                    'defaults' => [
                        'controller' => Controller\UsersController::class,
                        'action'     => 'connect',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\UsersController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'users' => __DIR__ . '/../view',
        ],
    ],
];
