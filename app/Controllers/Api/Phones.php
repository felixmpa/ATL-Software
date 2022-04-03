<?php

namespace AtlSoftware\Controllers\Api;

use AtlSoftware\Controllers\Controller;
use AtlSoftware\Models\Entity\Phone;
use AtlSoftware\Resources\Validation;

class Phones extends Controller
{
    protected $phone;

    public function __construct()
    {
        $this->phone = new Phone();
    }

    /*
    *   Return all phones
    */
    public function index()
    {
        $data = $this->phone->get();
        $this->response(200, $data, "success");
    }

    /*
    *   Return single phone
    *   Param $id {int}
    */
    public function show(int $id = 0)
    {
        if(!is_numeric($id))
            $this->response(400);
        
        $data = $this->phone->getById($id);
        $this->response(200, $data, "success");
    }

    /*
    *   Post a phone 
    *   Param $body {json}
    */
    public function store($body)
    {
        $val = new Validation($body, [
            'contact_id' => 'int',
            'number'     => 'int'
        ]);

        if($val->isSuccess()){
            
            $data = $this->phone->post($body);

            if($data){
                $this->response(201, $data, "Item stored successful");
            }else{
                $this->response(500);
            }

        }else{
            return $this->response(400, $val->errors);
        }        
    }

    /*
    *   Update a single phone
    *   Param $id {int}
    *   Param $body {json}
    */
    public function update(int $id = 0, $body)
    {
        $data = $this->phone->put($id, $body);
        
        if($data){
            $this->response(201, $data, "Item updated successful");
        }else{
            $this->response(500);
        }

    }

    /*
    *   Destroy sigle phone 
    *   Param $id {int}
    */
    public function destroy(int $id = 0)
    {
        if(!is_numeric($id))
            $this->response(400);
    
        $data = $this->phone->delete($id);

        $this->response(200, $data, "Item deleted successful");
    }

}