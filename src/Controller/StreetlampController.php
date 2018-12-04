<?php 
namespace Streetlamp\Controller;

use Streetlamp\Form\StreetlampForm;
use Streetlamp\Model\StreetlampModel;
use Zend\Db\Adapter\AdapterAwareTrait;
use Zend\Mvc\Controller\AbstractActionController;

class StreetlampController extends AbstractActionController
{
    use AdapterAwareTrait;
    
    public function indexAction()
    {
        $streetlamp = new StreetlampModel($this->adapter);
        $streetlamps = $streetlamp->fetchAll();
        
        return ([
            'streetlamps' => $streetlamps,    
        ]);
    }
    
    public function createAction()
    {
        $form = new StreetlampForm('createForm', $this->adapter);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $lamp = new StreetlampModel($this->adapter);
            
            $form->setInputFilter($lamp->getInputFilter());
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
                $lamp->exchangeArray($form->getData());
                $lamp->create();
                
                return $this->redirect()->toRoute('streetlamp', ['action' => 'accept']);
            }
        }
        
        return [
            'form' => $form,
        ];
    }
    
    public function acceptAction()
    {
        return ([]);
    }
    
    public function updateAction()
    {
        $uuid = $this->params()->fromRoute('uuid',0);
        if (!$uuid) {
            return $this->redirect()->toRoute('streetlamp');
        }
        
        $lamp = new StreetlampModel($this->adapter);
        $lamp->read(['UUID'=>$uuid]);
        
        $form = new StreetlampForm('updateForm', $this->adapter);
        $form->bind($lamp);
        $form->get('SUBMIT')->setAttribute('value', 'Update');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($lamp->getInputFilter());
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
                $lamp->update();
                return $this->redirect()->toRoute('streetlamp');
            }
            
        }
        
        return [
            'uuid' => $uuid,
            'form' => $form,
        ];
    }
    
    public function deleteAction()
    {
        $uuid = $this->params()->fromRoute('uuid', 0);
        if (!$uuid) {
            return $this->redirect()->toRoute('streetlamp');
        }
        
        $lamp = new StreetlampModel($this->adapter);
        $lamp->read(['UUID' => $uuid]);
        $lamp->delete();
        
        return $this->redirect()->toRoute('streetlamp');
    }
}
?>