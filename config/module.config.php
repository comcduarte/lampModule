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
    'acl' => [
        'guest' => [
            'streetlamp' => ['create', 'accept'],
        ],
        'member' => [
            'streetlamp' => ['index', 'create', 'update', 'delete'],
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
                'label' => 'Create New Street Lamp',
                'route' => 'streetlamp',
                'action' => 'create',
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