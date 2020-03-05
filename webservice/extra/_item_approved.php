<?php

include "db.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") {
    if (isset($_REQUEST['Item_Id']) && isset($_REQUEST['Item_Type']) && isset($_REQUEST['Item_Status'])) {
        $response = array();
        $Item_Id = $_REQUEST['Item_Id'];
        $Item_Type = $_REQUEST['Item_Type'];
        $Item_Status = $_REQUEST['Item_Status'];



        $created = date("Y-m-d H:i:s");
        $query = $db->query("SELECT * from auction_item where Item_Id= '$Item_Id' and  Item_Type= '$Item_Type' and Item_Status='$Item_Status'");
        if ($query->rowCount() > 0) {
            $response['success'] = 1;
            $response['message'] = "item is approved for purchase";
        } else {
            $response["success"] = 0;
            $response["message"] = "item is not approved for purchase";
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