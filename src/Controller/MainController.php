<?php 

namespace App\Controller;
use App\Entity\Contact;
use App\Entity\Phone;
use App\Entity\Email;


class MainController{

    public function Phonebook($pdo){
        $contact=new Contact($pdo);
        $response=$contact->read();
        if($response['code']==200){
        $contacts=array();
        $contacts["contacts"]=array();
        while ($row = $response['data']->fetch(\PDO::FETCH_ASSOC)){
            extract($row);
            //var_dump($row);
     
            $cont=array(
                "id" => $id,
                "firstname" => $firstname,
                "surname" => $surname
            );
     
            array_push($contacts["contacts"], $cont);
        }
        return json_encode($contacts);
    }
        return $response;

    }

    public function NewContact($pdo, $data){

        $contact=new Contact($pdo);
        $contact->setFirstname('Luis');
        $contact->setSurname('Mendoza');
        $response=$contact->create();
        return json_encode($response);

    }

    public function UpdateContact($id){

    }

    public function DeleteContact($id){

    }

}