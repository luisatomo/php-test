<?php

namespace App\Entity;

class Contact
{

    private $id;

    private $firstname;

    private $surname;

    private $conn;

    public function __construct(\PDO $pdo)
    {
        $this->conn = $pdo;
    }

    public function getId(){
        return $this->id;
    }
    
    public function getFirstname(){
        return $this->firstname;
    }

    public function setFirstname($firstname){
        $this->firstname=$firstname;
        return $this;
    }

    public function getSurname(){
        return $this->surname;
    }

    public function setSurname($surname){
        $this->surname=$surname;
        return $this;
    }

    public function create(){
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("INSERT INTO contact (id, firstname, surname) VALUES (NULL, ?, ?)");
            $stmt->bindParam(1, $this->firstname,\PDO::PARAM_STR);
            $stmt->bindParam(2, $this->surname,\PDO::PARAM_STR);
            $stmt->execute();
            $id=$this->conn->lastInsertId();
            $this->conn->commit();
            $success=array('code'=>200, 'message'=>'Success, Contact has been added', "id"=>$id);
            return $success;
        }catch (Exception $e){
            $this->conn->rollback();
            $error=array('code'=>400, 'message'=>$e->getMessage());
            return $error;
        }
    }

    

    public function updateContact($update, $id){
        try {
            $this->conn->beginTransaction();
            $query='UPDATE contact SET';
            $count=0;
            if(isset($update['firstname'])){
                $query.=' firstname = ?';
                $count++;
            }
            if(isset($update['surname'])){
                if($count>0)
                $query.=', ';
                $query.=' surname = ?';
                $count++;
            }
            $query.=' where id = ?';

            
            if($count>0){
                $stmt = $this->conn->prepare($query);
                $count=0;

                if(isset($update['firstname'])){
                $count++;
                $stmt->bindParam($count, $update['firstname'],\PDO::PARAM_STR);
                }
                
                if(isset($update['surname'])){
                $count++;
                $stmt->bindParam($count, $update['surname'],\PDO::PARAM_STR);
                }

                $count++;
                $stmt->bindParam($count, $id,\PDO::PARAM_INT);

                $stmt->execute();
                $this->conn->commit();
            }
            $success=array('code'=>200, 'message'=>'Success, Contact has been updated', "id"=>$id);
            return $success;
        }catch (Exception $e){
            $this->conn->rollback();
            $error=array('code'=>400, 'message'=>$e->getMessage());
            return $error;
        }
    }

    

    public function read(){
        try {
            //$this->conn->beginTransaction();
            $stmt = $this->conn->prepare("SELECT * FROM contact order by ?,?");
            $stmt->bindParam(1, $order,\PDO::PARAM_STR);
            $stmt->bindParam(2, $direction,\PDO::PARAM_STR);
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

    /*public function readOne($id){
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("select * from contact where id = ?");
            $stmt->bindParam(1, $id,\PDO::PARAM_INT);
            $stmt->execute();
            $this->conn->commit();
            //$success=array(200, 'Success');
            return $stmt;
        }catch (Exception $e){
            $this->conn->rollback();
            $error=array(400, $e->getMessage());
            return $error;
        }
    }*/

    public function delete($id){
        try {

            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("DELETE FROM contact where id = ?");
            $stmt->bindParam(1, $id,\PDO::PARAM_INT);
            $stmt->execute();
            $this->conn->commit();
            $success=array('code' => 200, 'message' => 'Success, The contact with id='.$id.' and their phones and emails have been deleted.');
            return $success;

        }catch (Exception $e){
            $this->conn->rollback();
            $error=array('code' => 400, 'message' => $e->getMessage());
            return $error;
            
        }
    }

}