<?php

include "db.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") {
    if (isset($_REQUEST['Seller_Id']) && isset($_REQUEST['User_Id'])) {


        $response = array();
        $Seller_Id = $_REQUEST['Seller_Id'];
        $User_Id = $_REQUEST['User_Id'];
        
        $item=$db->query("select * from auction_item where User_Id='$Seller_Id'");
        $feitem=$item->fetch();
        $order = $db->query("SELECT * from auction_user_order WHERE Seller_Id ='$Seller_Id' AND User_Id='$User_Id' AND Item_Id = '".$feitem['Item_Id']."'");
        $feorder = $order->fetch();
        
        
        $user = $db->query("select * from auction_user ");
        $feuser = $user->fetch();
        $trade = $db->query("select * from trade WHERE User_Id ='$Seller_Id' AND Receiver_Id='$User_Id' AND Item_Id = '".$feitem['Item_Id']."'");
        $fetrade = $trade->fetch();
        if ($fetrade['User_Id'] == $Seller_Id AND $fetrade['Receiver_Id'] == $User_Id AND  $fetrade['Item_Id']== $feitem['Item_Id'] OR $fetrade['Trade_Status']== '1') {
            $response["Trade_Accepted"] = "true";
        } else {
            $response["Trade_Accepted"] = "false";
        }
        
     
         
        if ($fetrade['User_Id'] == $Seller_Id AND $fetrade['Receiver_Id'] == $User_Id AND  $fetrade['Item_Id']== $feitem['Item_Id'] OR $fetrade['Trade_Status']== '2' ) {
            $response["Trade_Completed"] = "true";
        } else {
            $response["Trade_Completed"] = "false";
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