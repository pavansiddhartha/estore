<?php
include 'DBHANDLER.php';
$db=new DBHANDLER();
if(isset($_POST["UID"]) AND isset($_POST["NAME"]) AND isset($_POST["DESC"]) AND isset($_POST["IMG"])){
    if($db->check_login($_POST["UID"])){
        $response=$db->InsertCategories($_POST["UID"],$_POST["NAME"],$_POST["DESC"],$_POST["IMG"]);
        
    }

    echo json_encode($response);
}

?>
