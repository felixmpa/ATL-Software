<?php

namespace AtlSoftware;

use AtlSoftware\Resources\Configuration;
use AtlSoftware\Resources\Logging;
use AtlSoftware\Models\Database;
use AtlSoftware\Controllers\Routing;
use AtlSoftware\Controllers\Controller;

/*
* Why Facade? Because facade pattern is commonly used in PHP applications, where the facade classes simplify the work with complex libraries or APIs. 
* The Facade class provides a simple interface to the complex logic of one or several sub-class.
* The Facace delegates the client request to the appropriate object within AtlSoftware\App.
**/
class App
{

    protected $configuration;
    protected $logging;
    protected $rounting;
    protected $controller;

    public function __construct()
    {

        $this->configuration = new Configuration();
        $this->logging       = new Logging();
        $this->routing       = new Routing();
    }

    public function run()
    {
        //$this->database = $this->database->load();
        $this->rounting = $this->routing->load();

        //passing routing uri request
        $this->controller = new Controller($this->rounting);

    }
}