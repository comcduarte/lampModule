<?php 
namespace Streetlamp\Form;

use Midnet\Model\Uuid;
use Zend\Form\Form;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;

class StreetlampForm extends Form
{
    public function __construct($name = null)
    {
        $uuid = new Uuid();
        $date = new \DateTime('now',new \DateTimeZone('EDT'));
        $today = $date->format('Y-m-d H:m:s');
        parent::__construct($uuid->value);
        
        $this->add([
            'name' => 'UUID',
            'type' => Hidden::class,
            'attributes' => [
                'value' => $uuid->value,
                'id' => 'UUID',
            ],
        ]);
        
        $this->add([
            'name' => 'DATE_CREATED',
            'type' => Text::class,
            'attributes' => [
                'class' => 'form-control',
                'id' => 'DATE_CREATED',
                'required' => 'true',
                'placeholder' => '',
                'value' => $today,
            ],
            'options' => [
                'label' => 'Date Created',
            ],
        ]);
        
        $this->add([
            'name' => 'DATE_MODIFIED',
            'type' => Text::class,
            'attributes' => [
                'class' => 'form-control',
                'id' => 'DATE_MODIFIED',
                'required' => 'true',
                'placeholder' => '',
                'value' => $today,
            ],
            'options' => [
                'label' => 'Date Modified',
            ],
        ]);
        
        $this->add(new Csrf('SECURITY'));
        
        $this->add([
            'name' => 'SUBMIT',
            'type' => Submit::class,
            'attributes' => [
                'value' => 'Submit',
                'class' => 'btn btn-primary',
                'id' => 'SUBMIT',
            ],
        ]);
    }
}