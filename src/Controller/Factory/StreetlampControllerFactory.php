<?php 
namespace Streetlamp\Controller\Factory;

use Streetlamp\Controller\StreetlampController;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class StreetlampControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $controller = new StreetlampController();
        $controller->setAdapter($container->get('streetlamp-model-primary-adapter'));
        return $controller;
    }
}