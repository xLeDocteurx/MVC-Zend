<?php

namespace Users;

use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [

    // 'controllers' => [
    //     'factories' => [
    //         Controller\MoviesController::class => InvokableFactory::class,
    //     ],
    // ],

    // The following section is new and should be added to your file:
    'router' => [
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
    'view_manager' => [
        'template_path_stack' => [
            'movies' => __DIR__ . '/../view',
        ],
    ],
];