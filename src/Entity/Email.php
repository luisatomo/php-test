<?php

namespace App;

class Email
{
    private $email;

    private $contact;
    
    public function __construct()
    {
    }
    
    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email=$email;
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