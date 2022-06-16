<?php

include 'DBHANDLER.php';

$db= new DBHANDLER();
if(isset($_POST['ID'])){
    $ID=$_POST['ID'];
    if($db->check_login($ID)){
        $response = $db->getCategory();
        echo json_encode($response);
    }
}
?>