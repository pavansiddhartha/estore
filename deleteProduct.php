<?php
include 'DBHANDLER.php';
$db=new DBHANDLER();
if(isset($_POST["UID"]) AND isset($_POST["ID"])){
    if($db->check_login($_POST["UID"])){
        $response=$db->deleteProducts($_POST["UID"],$_POST["ID"]);
        
    }

    echo json_encode($response);
}


?>