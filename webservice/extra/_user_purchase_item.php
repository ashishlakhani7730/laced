<?php

header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") {

    if (isset($_REQUEST['Seller_Id']) && isset($_REQUEST['User_Id']) && isset($_REQUEST['Item_Id'])) {
        $response = array();
        include "db.php";
	$Seller_Id= $_REQUEST['Seller_Id'];
        $User_Id = $_REQUEST['User_Id'];
        $Item_Id = $_REQUEST['Item_Id'];
        $created = date("Y-m-d H:i:s");


        $insert = $db->query("INSERT INTO `user_purchase_item` (Seller_Id,User_Id,Item_Id, Purchase, created) VALUES 
                                                                ('$Seller_Id','$User_Id','$Item_Id', '0','$created')");
        $myinsert = $db->lastInsertId();
        if ($insert) {
            $response['success'] = 1;
            $response['message'] = "Your Purchse Successfully";
        } else {
            $response["success"] = 0;
            $response["message"] = "Your Purchse Not Successfully";
        }
    } else {
        $response["success"] = 0;
        $response["message"] = "Fields are missing";
    }
} else {
    $response["success"] = 0;
    $response["message"] = "Invalid Request Type(Use POST Method)";
}
echo json_encode($response);
?>
