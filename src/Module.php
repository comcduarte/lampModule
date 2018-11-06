<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Streetlamp;

use Zend\Db\Adapter\Adapter;

class Module
{

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                'streetlamp-model-primary-adapter' => function ($container) {
                    return new Adapter($container->get('streetlamp-model-primary-adapter-config'));
                }
            ]
        ];
    }
}