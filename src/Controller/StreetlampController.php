<?php 
namespace Streetlamp\Controller;

use Streetlamp\Model\StreetlampModel;
use Streetlamp\Traits\AdapterTrait;
use Zend\Mvc\Controller\AbstractActionController;

class StreetlampController extends AbstractActionController
{
    use AdapterTrait;
    
    public function indexAction()
    {
        $streetlamp = new StreetlampModel($this->adapter);
        $streetlamps = $streetlamp->fetchAll();
        
        return ([
            'streetlamp' => $streetlamps,    
        ]);
    }
}
?>