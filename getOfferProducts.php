<?php

include 'DBHANDLER.php';
$db=new DBHANDLER();
if(isset($_POST["UID"])){
    if($db->check_login($_POST["UID"])){
        $response = $db->getOfferproducts($_POST["UID"]);
        echo json_encode($response);
    }
}
?>