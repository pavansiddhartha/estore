<?php
include 'DBHANDLER.php';
$db=new DBHANDLER();
if(isset($_POST["UID"]) and isset($_POST["name"]) and isset($_POST["desc"]) and isset($_POST["perc"]) and isset($_POST["active"])){

    if($db->check_login($_POST["UID"])){
        $response=$db->insertDiscount($_POST["UID"],$_POST["name"],$_POST["desc"],$_POST["perc"],$_POST["active"]);
        
    }

    echo json_encode($response);
}