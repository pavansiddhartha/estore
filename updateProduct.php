<?php

include 'DBHANDLER.php';
$response=null;
$db= new DBHANDLER();
if(isset($_POST["UID"]) AND isset($_POST["ID"]) AND isset($_POST["PRODUCT_NAME"]) AND isset($_POST["PRICE"]) AND isset($_POST["RATING"]) AND isset($_POST["CATEGORY_ID"]) AND isset($_POST["DISCOUNT_ID"]) AND isset($_POST["QUANTITY"]) AND isset($_POST["DESCRIPTION"]) AND isset($_POST["FEATURES"]) AND isset($_POST["AVAILDISC"]) AND isset($_POST["IMGS"])){
    //echo "Post Successful";
    $ID=$_POST['ID'];
    if($db->check_login($ID)){
        $response=$db->updateproducts($_POST["UID"],$_POST["ID"],$_POST["PRODUCT_NAME"],$_POST["PRICE"],$_POST["RATING"],$_POST["CATEGORY_ID"],$_POST["DISCOUNT_ID"],$_POST["QUANTITY"],$_POST["DESCRIPTION"],$_POST["FEATURES"],$_POST["AVAILDISC"]);
    }
    echo json_encode($response);
}
?>