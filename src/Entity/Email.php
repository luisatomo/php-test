<?php

namespace App\Entity;

class Email
{
    private $email;

    private $contact;

    private $conn;

    
    public function __construct(\PDO $pdo)
    {
        $this->conn = $pdo;
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

    public function create(){
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("INSERT INTO email (id, email, contact_id) VALUES (NULL, ?, ?)");
            $stmt->bindParam(1, $this->email,\PDO::PARAM_STR);
            $stmt->bindParam(2, $this->contact,\PDO::PARAM_INT);
            $stmt->execute();
            $id=$this->conn->lastInsertId();
            $this->conn->commit();
            $success=array('code'=>200, 'message'=>'Success: Email '. $this->email. ' has been Added', "EmailID"=>$id);
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
            $stmt = $this->conn->prepare("SELECT * FROM email where contact_id = ?");
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
            $stmt = $this->conn->prepare("DELETE FROM email where contact_id = ?");
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


}