<?php

namespace Movies;

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
                        'controller' => Controller\MoviesController::class,
                        'action'     => 'register',
                    ],
                ],
            ],
            'connect' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/connect',
                    'defaults' => [
                        'controller' => Controller\MoviesController::class,
                        'action'     => 'connect',
                    ],
                ],
            ],
            'movies' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/movies[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\MoviesController::class,
                        'action'     => 'index',
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