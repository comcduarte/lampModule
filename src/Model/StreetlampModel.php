<?php 
namespace Streetlamp\Model;

use Midnet\Model\DatabaseObject;
use Zend\Validator\Digits;
use Zend\Validator\StringLength;

class StreetlampModel extends DatabaseObject
{
    public $UUID;
    public $STREET;
    public $INTERSECTING_STREET;
    public $HOUSE_NUMBER;
    public $POLE_NUMBER;
    public $ACTION;
    public $DESCRIPTION;
    public $PHONE_NUMBER;
    public $DATE_CREATED;
//     public $DATE_MODIFIED;
    
    public function __construct($dbAdapter = null)
    {
        parent::__construct($dbAdapter);
        
        $this->primary_key = 'UUID';
        $this->table = 'streetlamps';
    }
    
    public function getInputFilter()
    {
        $inputFilter = parent::getInputFilter();
        
        $inputFilter->add([
            'name' => 'POLE_NUMBER',
            'validators' => [
                [
                    'name' => Digits::class
                ],
            ],
        ]);
        
        $inputFilter->add([
            'name' => 'HOUSE_NUMBER',
            'validators' => [
                [
                    'name' => Digits::class
                ],
            ],
        ]);
        
        $inputFilter->add([
            'name' => 'PHONE_NUMBER',
            'validators' => [
                [
                    'name' => Digits::class
                ],
                [
                    'name' => StringLength::class,
                    'options' => [
                        'min' => 10,
                        'max' => 10,
                    ],
                ],
            ],
        ]);
        
        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }
}