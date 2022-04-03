<?php

namespace AtlSoftware\Resources;

class Validation 
{

    public $errors = array();
    public $data;
    public $validations;

    public function __construct($data, $validations)
    {
        $this->data = $data;
        $this->validations = $validations;
        $this->validate();
    }

    public function validate()
    {
        foreach($this->validations as $field => $pattern)
        {
            //validation by type
            if($this->data->$field == "" || $this->{"is_$pattern"}($this->data->$field) == false)
                $this->errors[$field] = "The field [$field] is not ".  $pattern;
        }
    }

    public function is_int($value){
        if(filter_var($value, FILTER_VALIDATE_INT)) return true;
        return false;
    }

    public function is_text($value)
    {
        if(filter_var($value, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => "/^[a-zA-Z]+$/")))) return true;
        return false;
    }

    public function is_email($value){
        if(filter_var($value, FILTER_VALIDATE_EMAIL)) return true;
        return false;
    }

    public function isSuccess()
    {
        if(empty($this->errors)) return true;
        return false;
    }

}