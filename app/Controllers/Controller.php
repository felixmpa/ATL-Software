<?php

namespace AtlSoftware\Controllers;

use AtlSoftware\Controllers\Routing;
use AtlSoftware\Models\Database;

class Controller
{
    protected $routing;
    protected $controller;

    //Inject dependencies
    //Controller::class construct create a tight coupling with Routes::class and Database:class
    public function __construct(Routing $routing)
    {
       $this->routing = $routing;

       if(class_exists($routing->controller))
       {
           $class = $routing->controller;
           $this->controller = new $class();
       }

       $this->action();
    }

    public function action()
    {
        switch($this->routing->method)
        {
            case "GET":

                if(is_numeric($this->routing->action))
                {
                    $id = (int)$this->routing->action;

                    $this->controller->show($id);

                }else{

                    $this->controller->index();

                }
                break;

            case "POST":

                $body = json_decode(\file_get_contents("php://input"));

                $this->controller->store($body);

                break;

            case "PUT":

                if(is_numeric($this->routing->action))
                {
                    $body = json_decode(\file_get_contents("php://input"));
                    $id   = (int)$this->routing->action;
                    $this->controller->update($id, $body);
                }
                break;

            case "DELETE":

                if(is_numeric($this->routing->action))
                    $this->controller->destroy((int)$this->routing->action);

                break;        

            default:
                response(404);
                break;
        }

    }

    /*
    * At the moment with only going to use
    * 200 -> OK
    * 201 -> CREATED
    * 202 -> ACCEPTED
    * 400 -> BAD REQUEST
    * 404 -> NOT FOUND
    */
    public function response($code, $data = [], $msg = "")
    {
        
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        if($code >= 200 && $code <= 202)
        {
            http_response_code($code);
            echo json_encode([
                'data' => $data,
                'msg'  => $msg 
            ]);
        }else{
            http_response_code($code);
            echo json_encode([
                'errors' => $data, 
            ]);
        }

    }
}