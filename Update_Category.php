<?php

include 'DBHANDLER.php';
$response=null;
$db= new DBHANDLER();
if(isset($_POST['UID']) and isset($_POST['ID']) and isset($_POST['NAME']) and isset($_POST['DESC']) and isset($_POST['img']) and isset($_POST['isimgchanged'])){
    //echo "Post Successful";
    $ID=$_POST['UID'];
    if($db->check_login($ID)){
        $response=$db->updateCategories($_POST['UID'],$_POST['ID'],$_POST['NAME'], $_POST['DESC'] , $_POST['img'] ,$_POST['isimgchanged']);
    }
    echo json_encode($response);
}
?>