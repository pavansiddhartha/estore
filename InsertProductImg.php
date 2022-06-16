<?php
include 'DBHANDLER.php';
$db=new DBHANDLER();
$response=array();
$response['status']=false;
if(isset($_POST["UID"]) AND isset($_POST["PID"]) AND isset($_POST["NAME"]) AND isset($_POST["IMG"])){
    if($db->check_login($_POST["UID"])){
        $response=$db->insertProductImg($_POST["UID"],$_POST["PID"],isset($_POST["NAME"]),isset($_POST["IMG"]));
    }

    echo json_encode($response);
}


?>