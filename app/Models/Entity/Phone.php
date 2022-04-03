<?php

namespace AtlSoftware\Models\Entity;

use AtlSoftware\Models\Database;
use AtlSoftware\Models\Entity\Repository;

class Phone extends Database
{
    use Repository;

    public $id;
    public $contact_id;
    public $code;
    public $number;
    public $ext;

    public $fields = [
        'id','contact_id','code','number','ext'
    ];

    public $table = "phones";
    
    public function __construct()
    {
        parent::__construct();
    }
}

