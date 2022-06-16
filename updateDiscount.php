<?php
include 'DBHANDLER.php';
$db=new DBHANDLER();
if(isset($_POST["UID"]) and isset($_POST["name"]) and isset($_POST["id"]) and isset($_POST["desc"]) and isset($_POST["perc"]) and isset($_POST["active"])){

    if($db->check_login($_POST["UID"])){
        $response=$db->updateDiscount($_POST["UID"],$_POST["id"],$_POST["name"],$_POST["desc"],$_POST["perc"],$_POST["active"]);
        
    }

    echo json_encode($response);
}