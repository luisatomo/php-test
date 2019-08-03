<?php

namespace App;

class Phone
{
    private $phone;

    private $contact;
    
    public function __construct()
    {
    }
    
    public function getPhone(){
        return $this->phone;
    }

    public function setPhone($phone){
        $this->phone=$phone;
        return $this;
    }

    public function getContact(){
        return $this->contact;
    }

    public function setContact($contact){
        $this->contact=$contact;
        return $this;
    }
}