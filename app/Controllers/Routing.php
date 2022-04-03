<?php

namespace AtlSoftware\Controllers;

class Routing 
{
    public $uri;
    public $controller;
    public $action;
    public $method;
    public $query;

    public function __construct()
    {
        $this->controller = "/";
        $this->uri    = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->query  = $_SERVER['QUERY_STRING'];
;    }

    public function load(): Routing
    {
        $target  = "/";
        //checking if uri contains prefix /api word or not
        if(strpos($this->uri, '/api') !== false) 
            $target = "/api";

        switch($target)
        {
            case '/':
                echo  'base';
                break;
            case '/api':
                
                $uri = explode("/",$this->uri);

                //getting the name of controller in the position uri[2]
                if(isset($uri[2]))
                    $this->controller = "AtlSoftware\Controllers\Api\\" . ucfirst($uri[2]);
                //getting the {id}
                if(isset($uri[3]))
                    $this->action = $uri[3];
                
                return $this;

                break;
            default:
                http_response_code(404);
                break;
        }
    }
}