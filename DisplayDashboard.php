<?php

include 'DBHANDLER.php';
$db=new DBHANDLER();
if(isset($_POST["UID"])){
    if($db->check_login($_POST["UID"])){
    $response = array();
    $response["status"]=false;
    $response["data"]=$db->getDashboardActivity($_POST["UID"]);
    if(!is_null($response["data"])){
        $response["status"]=true;
    }
    echo json_encode($response);
    }

}

?>