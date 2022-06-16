<?php
include 'DBHANDLER.php';
$db = new DBHANDLER();
if(isset($_POST["NAME"])){
$response=$db->getcount($_POST["NAME"]);
}
echo json_encode($response);
?>