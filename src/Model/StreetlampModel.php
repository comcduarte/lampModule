<?php 
namespace Streetlamp\Model;

use Midnet\Model\DatabaseObject;

class StreetlampModel extends DatabaseObject
{
    public $UUID;
    public $DATE_CREATED;
    public $DATE_MODIFIED;
    
    public function __construct($dbAdapter = null)
    {
        parent::__construct($dbAdapter);
        
        $this->primary_key = 'UUID';
        $this->table = 'streetlamps';
    }
}