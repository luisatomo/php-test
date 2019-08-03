<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require __DIR__ .'/vendor/autoload.php';
require __DIR__ .'/config.php';

error_reporting(E_ALL); ini_set('display_errors', 1);

$mc=new App\Controller\MainController();

$orderBy='id';

$direction='ASC';

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

    if( isset($_GET['direction'] ) ){

        if( $_GET['direction']=='ASC' 
            || $_GET['direction']=='DESC'  
        )
        $direction=$_GET['direction'];

    }
    
    switch($action){

        /* 
        * index.php?action=read&order=id&direction 
        */

        case 'read':

            echo $mc->Phonebook($pdo, $orderBy, $direction);

        break;

        /* 
        * index.php?action=create
        * POST JSON data
        {
            "data": 
            [ 
                {"firstname":"Luis T", "surname":"Mendoza", 
                    "emails":[{"email":"luis@atomoweb.com"},
                        {"email":"info@atomoweb.com"}], 
                    "phones":[{"phone":"+591.79821755"},
                    {"phone":"+591.12323232"}] },
                {"firstname":"F T", "surname":"Terrazas", 
                    "emails":[{"email":"luis2@atomoweb.com"},
                        {"email":"info2@atomoweb.com"}], 
                        "phones":[{"phone":"+591.78881455"},
                        {"phone":"+591.14324232"}] }
            ]
        }
        */
        
        case 'create':

            $json = file_get_contents('php://input');

            if($json){

                $data=json_decode($json);
        
                echo $mc->NewContact($pdo, $data);
        
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

            echo $mc->Phonebook($pdo, $orderBy, $direction);

        break;
    }
}
else{

    echo $mc->Phonebook($pdo, $orderBy, $direction);

}
//echo $mc->NewContact($pdo);


