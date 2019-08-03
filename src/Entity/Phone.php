<?php

namespace App\Entity;

class Phone
{
    private $phone;

    private $contact;
    
    public function __construct(\PDO $pdo)
    {
        $this->conn = $pdo;
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

    public function create(){
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("INSERT INTO phone (id, phone, contact_id) VALUES (NULL, ?, ?)");
            $stmt->bindParam(1, $this->phone,\PDO::PARAM_STR);
            $stmt->bindParam(2, $this->contact,\PDO::PARAM_INT);
            $stmt->execute();
            $id=$this->conn->lastInsertId();
            $this->conn->commit();
            $success=array('code'=>200, 'message'=>'Success: Phone '. $this->phone. ' has been Added', "PhoneID"=>$id);
            return $success;
        }catch (Exception $e){
            $this->conn->rollback();
            $error=array('code'=>400, 'message'=>$e->getMessage());
            return $error;
        }
    }

    public function read($id){
        try {
            //$this->conn->beginTransaction();
            $stmt = $this->conn->prepare("select * from phone where contact_id = ?");
            $stmt->bindParam(1, $id,\PDO::PARAM_INT);
            $stmt->execute();
            //$this->conn->commit();
            //$success=array(200, 'Success');
            $success=array('code' => 200, 'message' => 'Success', 'data' => $stmt);
            return $success;
        }catch (Exception $e){
            $this->conn->rollback();
            $error=array('code' => 400, 'message' => $e->getMessage());
            return $error;
        }
    }
}