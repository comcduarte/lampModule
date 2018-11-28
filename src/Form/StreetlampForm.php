<?php 
namespace Streetlamp\Form;

use Midnet\Model\Uuid;
use Zend\Form\Form;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Db\Sql\Sql as Sql;
use Zend\Db\Sql\Select as SqlSelect;
use Midnet\Traits\AdapterTrait;
use Zend\Form\Element\Select;
use Zend\Stdlib\Exception\RuntimeException;
use Zend\Form\Element\Textarea;

class StreetlampForm extends Form
{
    use AdapterTrait;
    
    public function __construct($name = null, $dbAdapter = null)
    {
        $this->setAdapter($dbAdapter);
        
        $uuid = new Uuid();
        $date = new \DateTime('now',new \DateTimeZone('EDT'));
        $today = $date->format('Y-m-d H:i:s');
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
            'name' => 'POLE_NUMBER',
            'type' => Text::class,
            'attributes' => [
                'class' => 'form-control',
                'id' => 'POLE_NUMBER',
                'required' => 'true',
                'placeholder' => '',
            ],
            'options' => [
                'label' => 'Pole Number',
            ],
        ]);
        
        $this->add([
            'name' => 'HOUSE_NUMBER',
            'type' => Text::class,
            'attributes' => [
                'class' => 'form-control',
                'id' => 'HOUSE_NUMBER',
                'required' => 'true',
                'placeholder' => '',
            ],
            'options' => [
                'label' => 'House Number',
            ],
        ]);
        
        $this->add([
            'name' => 'STREET',
            'type' => Text::class,
            'attributes' => [
                'class' => 'form-control',
                'id' => 'STREET',
                'required' => 'true',
                'placeholder' => '',
            ],
            'options' => [
                'label' => 'Street',
            ],
        ]);
        
        $this->add([
            'name' => 'INTERSECTING_STREET',
            'type' => Text::class,
            'attributes' => [
                'class' => 'form-control',
                'id' => 'INTERSECTING_STREET',
                'required' => 'true',
                'placeholder' => '',
            ],
            'options' => [
                'label' => 'Intersecting Street',
            ],
        ]);
        
        $value_options = $this->getSelectValueOptions('actions','ACTION','ACTION');
        
        $this->add([
            'name' => 'ACTION',
            'type' => Select::class,
            'attributes' => [
                'class' => 'form-control',
                'id' => 'ACTION',
                'required' => 'true',
                'placeholder' => '',
            ],
            'options' => [
                'label' => 'Action',
                'value_options' => $value_options,
            ],
        ]);
        
        $this->add([
            'name' => 'DESCRIPTION',
            'type' => Textarea::class,
            'attributes' => [
                'class' => 'form-control',
                'id' => 'DESCRIPTION',
                'required' => 'true',
                'placeholder' => '',
            ],
            'options' => [
                'label' => 'Description',
            ],
        ]);
        
        $this->add([
            'name' => 'PHONE_NUMBER',
            'type' => Text::class,
            'attributes' => [
                'class' => 'form-control',
                'id' => 'PHONE_NUMBER',
                'required' => 'true',
                'placeholder' => '',
            ],
            'options' => [
                'label' => 'Phone Number',
            ],
        ]);
        
        $this->add([
            'name' => 'DATE_CREATED',
            'type' => Hidden::class,
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
        
//         $this->add([
//             'name' => 'DATE_MODIFIED',
//             'type' => Text::class,
//             'attributes' => [
//                 'class' => 'form-control',
//                 'id' => 'DATE_MODIFIED',
//                 'required' => 'true',
//                 'placeholder' => '',
//                 'value' => $today,
//             ],
//             'options' => [
//                 'label' => 'Date Modified',
//             ],
//         ]);
        
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

    public function getSelectValueOptions($table = null, $id_col = null, $val_col = null)
    {
        $sql = new Sql($this->adapter);
        
        $select = new SqlSelect();
        $select->from($table);
        $select->columns([$id_col => $id_col, $val_col => $val_col]);
        
        $statement = $sql->prepareStatementForSqlObject($select);
        
        try {
            $resultSet = $statement->execute();
        } catch (RuntimeException $e) {
            return $e;
        }
        
        foreach ($resultSet as $id => $object) {
            $options[$object[$id_col]] = $object[$val_col];
        }
        
        return $options;
    }
}