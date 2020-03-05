<?php

include "db.php";
include "function.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") {
    if (isset($_REQUEST['Order_Id']) ) {

        $response = array();


        
        $Order_Id = $_REQUEST['Order_Id'];

        
            $Tracking_No1 = substr(md5(rand()), 0, 9);
            $Tracking_No2 = substr(md5(rand()), 0, 9);
            $Order = $db->query("SELECT * FROM auction_user_order WHERE  Order_Id='$Order_Id' ");
            $feOrder = $Order->fetch();

  	    $trade = $db->query("SELECT * FROM trade");
            $fetrade = $trade ->fetch();
            
            	$db->query("UPDATE auction_user_order SET Tracking_No1='$Tracking_No1' WHERE Order_Id='$Order_Id' ");
            
            
            	$db->query("UPDATE auction_user_order SET Tracking_No2='$Tracking_No2' WHERE Order_Id='$Order_Id' ");
            
            $update = $db->query("UPDATE `trade` SET `Trade_Status`= '2' WHERE  Receiver_Id='" . $feOrder['User_Id'] . "'  AND Item_Id = '" . $feOrder['Item_Id'] . "' ");


            if ($update) {
                $response['success'] = 1;
                $response['message'] = "Item Shipped";
            } else {
                $response['success'] = 0;
                $response['message'] = "Item Not Shipped";
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

