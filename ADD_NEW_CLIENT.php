<?php
include 'DBHANDLER.php';
$db = new DBHANDLER();

$data=array();
$data["error"]=true;
if(isset($_POST["NAME"])&&isset($_POST["BUSINESS_NAME"])&&isset($_POST["LOGO"])&&isset($_POST["EMAIL_ID"])&&isset($_POST["PASSWORD"])&&isset($_POST["CONTACT"])
&&isset($_POST["LOCATION_NAME"])&&isset($_POST["LATITUDE"])&&isset($_POST["LONGITUDE"])&&isset($_POST["ACTIVE_STATE"]) &&isset($_POST["MIN"])&&isset($_POST["R"])&&isset($_POST["TYPE_ID"]) ){
	
 $NAME = $_POST["NAME"];
 $BUSINESS_NAME = $_POST["BUSINESS_NAME"];
 $LOGO = $_POST["LOGO"];
 $EMAIL_ID = $_POST["EMAIL_ID"];
 $PASSWORD = $_POST["PASSWORD"];
 $CONTACT = $_POST["CONTACT"];
 $LOCATION_NAME = $_POST["LOCATION_NAME"];
 $LATITUDE = $_POST["LATITUDE"];
 $LONGITUDE = $_POST["LONGITUDE"];
 $ACTIVE_STATE = $_POST["ACTIVE_STATE"];
 $MP=$_POST["MIN"];
 $R=$_POST["R"];
 $TYPE_ID=$_POST["TYPE_ID"];
 
 
 $response=$db->addNewClient($NAME,$BUSINESS_NAME,$LOGO,$EMAIL_ID,$PASSWORD,$CONTACT,$LOCATION_NAME,$LATITUDE,$LONGITUDE,$ACTIVE_STATE,$MP,$R,$TYPE_ID);
    
    if($response){
        
        $data["error"]=false;
    }

}



echo json_encode($data);

?>