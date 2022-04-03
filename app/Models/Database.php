<?php

namespace AtlSoftware\Models;

use PDO;
use PDOException;

class Database extends PDO
{
    private $driver;
    private $host;
    private $name;
    private $user;
    private $password;
    protected $connection;

    public function __construct()
    {
        $this->driver    = db_driver;
        $this->host     = db_host;
        $this->name     = db_name;
        $this->user     = db_user;
        $this->password = db_password;

        $this->connection = null;

        try 
        {
            $this->connection = new PDO($this->driver.":host=" . $this->host . ";dbname=" . $this->name, $this->user, $this->password);
            
        }catch(PDOException $e)
        {
            echo "Connection error: ". $e->getMessage();
            exit();
        }

    }


    public function get()
    {
        
    }

}
