<?php

header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") {

    if (isset($_REQUEST['Item_Id']) && isset($_REQUEST['Shipping_Address']) ) {
        $response = array();
        include "db.php";

        $Item_Id = $_REQUEST['Item_Id'];
        $Shipping_Address = $_REQUEST['Shipping_Address'];
        
        $created = date("Y-m-d H:i:s");


        $insert = $db->query("INSERT INTO `auction_shipping` (Item_Id,Shipping_Address, created) VALUES 
                                                                ('$Item_Id','$Shipping_Address','$created')");
        $myinsert = $db->lastInsertId();
        if ($insert) {
            $response['success'] = 1;
            $response['message'] = "Your shipping Successfully";
        } else {
            $response["success"] = 0;
            $response["message"] = "Your shipping Not Successfully";
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
