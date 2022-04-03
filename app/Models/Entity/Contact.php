<?php

namespace AtlSoftware\Models\Entity;

use AtlSoftware\Models\Database;
use AtlSoftware\Models\Entity\Repository;


class Contact extends Database
{
    use Repository;

    public $id;
    public $name;
    public $lastname;
    public $email;

    public $fields = [
        'id','name','lastname','email'
    ];

    public $table = "contacts";
    
    public function __construct()
    {
        parent::__construct();
    }
}

