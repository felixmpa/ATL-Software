<?php

namespace AtlSoftware\Controllers\Api;

use AtlSoftware\Controllers\Controller;
use AtlSoftware\Models\Entity\Contact;
use AtlSoftware\Models\Entity\Phone;
use AtlSoftware\Resources\Validation;

class Contacts extends Controller
{
    protected $contact;

    public function __construct()
    {
        $this->contact = new Contact();
    }

    /*
    *   Return all contacts
    */
    public function index()
    {
        $data = $this->contact->get();
        $this->response(200, $data, "success");
    }

    /*
    *   Return single contact
    *   Param $id {int}
    */
    public function show(int $id = 0)
    {
        if(!is_numeric($id))
            $this->response(400);
        
        $data = $this->contact->getById($id);
        $this->response(200, $data, "success");
    }

    /*
    *   Post a contact 
    *   Param $body {json}
    */
    public function store($body)
    {
        $val = new Validation($body, [
            'name' => 'text',
            'email' => 'email'
        ]);

        if($val->isSuccess()){
            
            $id = $this->contact->post($body);

            if($id > 0){

                //handy phones appened to json
                $this->storing_phones($body, $id);

                $this->response(201, ['id' => $id], "Item stored successful");
            }else{
                $this->response(500);
            }

        }else{
            return $this->response(400, $val->errors);
        }        
    }

    /*
    *   Update a single contact
    *   Param $id {int}
    *   Param $body {json}
    */
    public function update(int $id = 0, $body)
    {
        $data = $this->contact->put($id, $body);
        
        if($data){
            $this->response(201, $data, "Item updated successful");
        }else{
            $this->response(500);
        }

    }

    /*
    *   Destroy sigle contact 
    *   Param $id {int}
    */
    public function destroy(int $id = 0)
    {
        if(!is_numeric($id))
            $this->response(400);
    
        $data = $this->contact->delete($id);

        $this->response(200, $data, "Item deleted successful");
    }



    private function storing_phones($body, $id)
    {
        if(isset($body->phone))
        {
            foreach($body->phone as $phone)
            {
                $phone->contact_id = $id;
                $phone->ext = ($phone->ext  == "") ? "N/A" : $phone->ext ;
                $model = new Phone();
                $model->post($phone);
            }
        }
    }

}