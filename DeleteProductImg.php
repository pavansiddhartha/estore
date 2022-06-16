<?php
include 'DBHANDLER.php';
$db=new DBHANDLER();
$response=array();
$response['status']=false;
if(isset($_POST["UID"]) AND isset($_POST["PID"]) AND isset($_POST["NAME"])){
    if($db->check_login($_POST["UID"])){
        $response=$db->deleteProductImg($_POST["UID"],$_POST["PID"],isset($_POST["NAME"]));
    }

    echo json_encode($response);
}


?>