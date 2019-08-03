<?php 

namespace App\Controller;
use App\Entity\Contact;
use App\Entity\Phone;
use App\Entity\Email;


class MainController{

    public function Phonebook($pdo, $order='id', $direction='ASC'){
        
        $contact=new Contact($pdo);
        $response=$contact->read($order, $direction);
        
        if($response['code']==200){
        
            $contacts=array();
            $contacts["contacts"]=array();
        
            while ($row = $response['data']->fetch(\PDO::FETCH_ASSOC)){
            
                extract($row);

                $cont=array(
                "id" => $id,
                "firstname" => $firstname,
                "surname" => $surname,
                "emails" => [],
                "phones" => []
                );

                $email=new Email($pdo);
                $responseEmail=$email->read($id);

                if($response['code']==200){
                    //$emails=array();

                    while ($rowEmail = $responseEmail['data']->fetch(\PDO::FETCH_ASSOC)){
                        
                        extract($rowEmail);

                        $ema=array(
                            'EmailID' => $id,
                            'Email' => $email
                        );

                        array_push($cont["emails"], $ema);

                    }


                }

                $phone=new Phone($pdo);
                $responsePhone=$phone->read($id);

                if($response['code']==200){
                    //$phones=array();

                    while ($rowPhone = $responsePhone['data']->fetch(\PDO::FETCH_ASSOC)){
                        
                        extract($rowPhone);

                        $pho=array(
                            'PhoneID' => $id,
                            'Phone' => $phone
                        );

                        array_push($cont["phones"], $pho);

                    }


                }
     
                array_push($contacts["contacts"], $cont);
            }
        
        return json_encode($contacts);

        }

        return $response;

    }

    public function NewContact($pdo, $data){

        $jsondata=array();
        $jsondata['data']=array();
        
        if($data->data){
            
            $contacts=$data->data;
            $jsoncontacts=array();
            $jsoncontacts['contacts']=array();
            
            foreach( $contacts as $row ){
                
                $jsoncontact=array();
                $jsoncontact['contact']=array();
                $jsoncontact['emails']=array();
                $jsoncontact['phones']=array();

                $contact=new Contact($pdo);
                $contact->setFirstname($row->firstname);
                $contact->setSurname($row->surname);
                
                $response=$contact->create();
                array_push($jsoncontact['contact'],$response);
                
                $id=$response['id']; 
                
                if(isset($row->emails)){
            
                    $emails=$row->emails;
                    
                    foreach($emails as $rowEmail){
                    
                        $email=new Email($pdo);
                        $email->setEmail($rowEmail->email);
                        $email->setContact($id);
                        $response=$email->create();
                
                        array_push($jsoncontact['emails'], $response);
                    }
                }
                
                if(isset($row->phones)){

                    $phones=$row->phones;
                    
                    foreach($phones as $rowPhone){

                        $phone=new Phone($pdo);
                        $phone->setPhone($rowPhone->phone);
                        $phone->setContact($id);
                        $response=$phone->create();
            
                        array_push($jsoncontact['phones'], $response);
                    }

                }
        
                array_push($jsoncontacts['contacts'], $jsoncontact);
            }
        
        return json_encode($jsoncontacts);

        }

    }

    public function UpdateContact($id){

    }

    public function DeleteContact($id){

    }

}