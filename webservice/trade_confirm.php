<?php

include "db.php";
include "function.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") {
    if (isset($_REQUEST['User_Id']) ) {

        $response = array();

        $User_Id= $_REQUEST['User_Id'];
        $created = date("Y-m-d H:i:s");

        $trade=$db->query("SELECT * FROM trade WHERE User_Id='$User_Id' AND Trade_Status='1'");
        

        if ($trade->Rowcount() > 0) {
            $i = 0;
            $d = '';
            $ph = array();
            

            while ($fetrade=$trade->fetch()) {
               
                $user = $db->query("SELECT * FROM `auction_user` WHERE  User_Id='".$fetrade['Receiver_Id']."'");
                $feuser=$user->fetch();
                $ph[$i]["Trade_Id"] = $fetrade['Trade_Id'];
                
                $ph[$i]["User_Id"] = $feuser['User_Id'];

                $ph[$i]["User_Name"] = $feuser['User_Name'];
                
                
                $order=$db->query("SELECT * FROM auction_user_order WHERE Seller_Id='".$fetrade['User_Id']."' AND Item_Id='".$fetrade['Item_Id']."' ");
                $feorder=$order->fetch();
                
                
                $ph[$i]["Order_Id"] = $feorder['Order_Id'];
                $ph[$i]["User_Address"] = $feuser['User_Address']!= '' ? $feuser['User_Address'] : '';
                
                
                $i++;
            }
            if (sizeof($ph) > 0) {
                $response['success'] = 1;
                $response['TradeConfirm'] = $ph;
                $response['message'] = "trade confirm list";
            } else {
                $response['success'] = 0;
                $response['message'] = "trade not confirm found";
            }
        } else {
            $response['success'] = 0;
            $response['message'] = "No List found";
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
