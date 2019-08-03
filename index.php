<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require __DIR__ .'/vendor/autoload.php';
require __DIR__ .'/config.php';

$mc=new App\Controller\MainController();

$orderBy='id';

if(isset($_GET['action']) && $_GET['action']!=''){
    
    $action=$_GET['action'];


    if( isset($_GET['order'] ) ){

        if( $_GET['order']=='email' 
            || $_GET['order']=='phone' 
            || $_GET['order']=='firstname'
            || $_GET['order']=='surname'  
        )
        $orderBy=$_GET['order'];

    }
    
    switch($action){

        case 'read':

            echo $mc->Phonebook($pdo, $orderBy);

        break;
        
        case 'create':

            if(isset($_POST['data']) ){

                $data=json_decode($_POST['data']);
        
                echo $mc->Create($pdo, $data);
        
            }

        break;
        
        case 'update':

            if(isset($_POST['data']) && isset($_GET['id'])){

                $id=$_GET['id'];

                $data=json_decode($_POST['data']);
        
                echo $mc->Update($pdo, $id, $data );
        
            }

        break;

        case 'delete':

            if(isset($_GET['id'])){

                $data=json_decode($_POST['data']);
    
                echo $mc->Delete($pdo, $id);
    
            }

        break;

        default:

            echo $mc->Phonebook($pdo, $orderBy);

        break;
    }
}
else{

    echo $mc->Phonebook($pdo, $orderBy);

}
//echo $mc->NewContact($pdo);


