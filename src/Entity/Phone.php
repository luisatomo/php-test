<?php

namespace App\Entity;

class Phone
{
    private $phone;

    private $contact;

    private $conn;

    
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
            $stmt = $this->conn->prepare("SELECT * FROM phone where contact_id = ?");
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

    public function delete($id){
        try {

            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("DELETE FROM phone where contact_id = ?");
            $stmt->bindParam(1, $id,\PDO::PARAM_INT);
            $stmt->execute();
            $this->conn->commit();
            $success=array('code' => 200, 'message' => 'Deleted');
            return $success;

        }catch (Exception $e){
            $this->conn->rollback();
            $error=array('code' => 400, 'message' => $e->getMessage());
            return $error;
            
        }
    }

    public function updatePhone($phone, $id, $contact){
        try {
            //echo $phone, $id, $contact;
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("UPDATE phone SET phone = ? where id = ? and contact_id = ?");
            $stmt->bindParam(1, $phone,\PDO::PARAM_STR);
            $stmt->bindParam(2, $id,\PDO::PARAM_INT);
            $stmt->bindParam(3, $contact,\PDO::PARAM_INT);
            $stmt->execute();
            $countr = $stmt->rowCount();
            $this->conn->commit();
            if($countr>0)
            $success=array('code'=>200, 'message'=>'Success, Phone has been updated', "id"=>$id);
            else
            $success=array('code'=>200, 'message'=>'Phone has not been updated', "id"=>$id);
            return $success;
        }catch (Exception $e){
            $this->conn->rollback();
            $error=array('code'=>400, 'message'=>$e->getMessage());
            return $error;
        }
    }

}