<?php
include dirname(__FILE__) .'\DBHANDLER.php';
$db = new DBHANDLER();
$response=array();
        
$response["status"]=false;
if(isset($_POST['USERNAME']) && isset($_POST['PASSWORD'])){
    //echo "post successful";
    $username= $_POST["USERNAME"];
$password= $_POST["PASSWORD"];
$response["data"]=$db->get_user($username,$password);
if(!is_null($response["data"])){
    $response["status"]=true;
}

 
}
echo json_encode($response);
?>