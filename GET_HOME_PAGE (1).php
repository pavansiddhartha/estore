<?php
include 'DBHANDLER.php';
$db = new DBHANDLER();
$response=array();
        $response["STATUS"]=false;

if(isset($_POST["UID"])){
 
 $UID=$_POST["UID"];   
 // update users engagements log with app
 
 
 
 
 $result=$db->FetchHomePage();
 if($result!=null){
    
    $response["STATUS"]=true;
    $response["DATA"]=$result;
    
}else{
    
        $response["STATUS"]=false;
}


}



echo json_encode($response);

?>
