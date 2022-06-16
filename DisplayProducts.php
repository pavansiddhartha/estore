<?php

include 'DBHANDLER.php';
$db=new DBHANDLER();
if(isset($_POST["UID"])){
    if($db->check_login($_POST["UID"])){
    $response = array();
    $response["status"]=false;
    if(isset($_POST["ID"]))
    $response["data"]=$db->DisplayProducts($_POST["UID"],$_POST["ID"]);
    else
    $response["data"]=$db->DisplayProducts($_POST["UID"]);
    if(!is_null($response["data"])){
        $response["status"]=true;
    }
    echo json_encode($response);
    }

}

?>