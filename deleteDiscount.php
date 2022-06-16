<?php
include 'DBHANDLER.php';
$db=new DBHANDLER();
if(isset($_POST["UID"]) and isset($_POST["id"])){
    if($db->check_login($_POST["UID"])){
        $response=$db->deleteDiscount($_POST["UID"],$_POST["id"]);
    }
    echo json_encode($response);
}