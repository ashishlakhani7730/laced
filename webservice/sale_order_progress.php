<?php

include "db.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") {
    if (isset($_REQUEST['Order_Id']) ) {


        $response = array();
        $Order_Id = $_REQUEST['Order_Id'];
        
        $item=$db->query("select * from auction_item ");
        $feitem=$item->fetch();
        $Order = $db->query("SELECT * FROM auction_user_order WHERE  Order_Id='$Order_Id' ");
            $feOrder = $Order->fetch();
        if ($feOrder['Order_Id']== $Order_Id OR $feOrder['Order_Status'] == '1') {
            $response["Ordered"] = "Success";
        } else {
            $response["Ordered"] = "Fail";
        }
        
        $sale = $db->query("select * from user_purchase_item where Seller_Id='".$feOrder['Seller_Id']."' AND User_Id='".$feOrder['User_Id']."'");
        $fesale = $sale->fetch();
        if ($fesale['Seller_Id']== $feOrder['Seller_Id'] OR $fesale['Purchase']== '1') {
            $response["Seller_Confirmed"] = "Success";
        } else {
            $response["Seller_Confirmed"] = "Fail";
        }
        
        
        
        
        
       
        
         if ( $fesale['Purchase']== '2' ) {
            $response["Purchase_Completed"] = "Success";
        } else {
            $response["Purchase_Completed"] = "Fail";
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