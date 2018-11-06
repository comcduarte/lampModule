<?php 
namespace Streetlamp;

use Streetlamp\Controller\StreetlampController;
use Streetlamp\Controller\Factory\StreetlampControllerFactory;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'streetlamp' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/streetlamp[/:controller[/:action[/:uuid]]]',
                    'defaults' => [
                        'controller' => 'streetlamp',
                        'action'     => 'index',
                    ],
                    'constraints' => [
                        'controller' => '[a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z0-9_-]*',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            StreetlampController::class => StreetlampControllerFactory::class,
        ],
        'aliases' => [
            'streetlamp' => Controller\StreetlampController::class,
        ],
    ],
    'navigation' => [
        'default' => [
            [
                'label' => 'Street Lamp',
                'route' => 'streetlamp',
                'pages' => [
                    [
                        'label' => 'Create New Street Lamp',
                        'route' => 'streetlamp',
                        'controller' => 'streetlamp',
                        'action' => 'create',
                    ],
                    [
                        'label' => 'List Street Lamps',
                        'route' => 'streetlamp',
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'aliases' => [
            'streetlamp-model-primary-adapter-config' => 'model-primary-adapter-config',
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];