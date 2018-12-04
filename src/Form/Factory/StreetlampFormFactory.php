<?php 
namespace Streetlamp\Form\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Streetlamp\Form\StreetlampForm;

class StreetlampFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $form = new StreetlampForm();
        $form->setDbAdapter($container->get('streetlamp-model-primary-adapter'));
        return $form;
    }
}