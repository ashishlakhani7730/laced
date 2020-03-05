<?php

include "db.php";
include "function.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") {
    if (isset($_REQUEST['User_Id'])) {
        $response = array();
        $User_Id = $_REQUEST['User_Id'];
        $current_date = (date("Y-m-d H:i:s"));
        $trade = array(); $t= 0;
        $tradelist = $db->query("SELECT * FROM `trade` WHERE Trade_Status = '1' AND ( User_Id = '$User_Id' OR Receiver_Id = '$User_Id')");
        while ($fetradelist = $tradelist->fetch()) 
        {
            $trade[$t]["Trade_Id"] = $fetradelist['Trade_Id'];

            $order = $db->query("SELECT * FROM auction_user_order WHERE User_Id = '$User_Id' AND Item_Id ='".$fetradelist['Trade_Id']."'  AND Order_Type = 'TRADE'");
            $feorder = $order->fetch();

            $trade[$t]["Tracking_No"] = $feorder['Tracking_No2'] != '' ? $feorder['Tracking_No2'] : $feorder['Tracking_No1'];
            $trade[$t]["Order_Id"] = $feorder['Order_Id'];
            $trade[$t]["Is_Trade_cancelled"] = $fetradelist['is_cancelled'];
            $trade[$t]["Trade_Accepted_On"] = $feorder['created'];

            $UserID = $fetradelist['User_Id'] == $User_Id ?  $fetradelist['Receiver_Id'] : $fetradelist['User_Id'];
            $user = $db->query("SELECT User_Name FROM auction_user WHERE User_Id = '$UserID'");
            $feuser = $user->fetch();
            $trade[$t]["Seller_Name"] = $feuser['User_Name'];

            $item = $db->query("SELECT * FROM auction_item WHERE Item_Id = '".$fetradelist['have_Item_Id']."'");
            $feitem = $item->fetch();
            $brand = $db->query("SELECT * FROM auction_brand WHERE Brand_Id = '".$feitem['Brand_Id']."'");
            $febrand = $brand->fetch();
            $outside = array(); $o = 0;
            $outside[$o]["Item_Id"] = $feitem['Item_Id'];
            $outside[$o]["Item_Name"] = $feitem['Item_Name'];  
            $outside[$o]["Brand_Name"] = ($febrand['Brand_Name']) ? $febrand['Brand_Name'] : '';
            $outside[$o]["Item_FrontPicture"] = $feitem['Item_FrontPicture'] != '' ? $DefaultUrl . $feitem['Item_FrontPicture'] : $feitem['Item_FrontPicture'];
            $outside[$o]["Item_NormalPrice"] = $feitem['Item_NormalPrice'];
            $outside[$o]["Item_Condition"] = $feitem['Item_Condition'];
            $outside[$o]["Item_Size"] = $feitem['Item_Size'];
            $outside[$o]["Item_Box"] = $feitem['Item_Availability'];
            $o++;
            $inside = array();
            $items_id = explode(",", $fetradelist['Item_Id']);

            for ($in = 0; $in < count($items_id); $in++) {
                $item = $db->query("SELECT * FROM auction_item WHERE Item_Id = '" . $items_id[$in] . "'");
                $feitem = $item->fetch();
                $brand = $db->query("SELECT * FROM auction_brand WHERE Brand_Id = '".$feitem['Brand_Id']."'");
                $febrand = $brand->fetch();
                $inside[$in]["Item_Id"] = $feitem['Item_Id'];
                $inside[$in]["Item_Name"] = $feitem['Item_Name'];  
                $inside[$in]["Brand_Name"] = ($febrand['Brand_Name']) ? $febrand['Brand_Name'] : '';
                $inside[$in]["Item_FrontPicture"] = $feitem['Item_FrontPicture'] != '' ? $DefaultUrl . $feitem['Item_FrontPicture'] : $feitem['Item_FrontPicture'];
                $inside[$in]["Item_NormalPrice"] = $feitem['Item_NormalPrice'];
                $inside[$in]["Item_Condition"] = $feitem['Item_Condition'];
                $inside[$in]["Item_Size"] = $feitem['Item_Size'];
                $inside[$in]["Item_Box"] = $feitem['Item_Availability'];
            }
            if($fetradelist['User_Id'] == $User_Id):
                $trade[$t]["myItem"] = $outside;
                $trade[$t]["insideItem"] = $inside; 
            else:
                $trade[$t]["myItem"] = $inside;
                $trade[$t]["insideItem"] = $outside; 
            endif;
            
            $t++;
        }

        $order = $db->query("SELECT * FROM auction_user_order WHERE  User_Id = '$User_Id' AND Order_Type != 'TRADE'");
        $purchase = array(); $p = 0;
        while ($feorder = $order->fetch()) {
            $item = $db->query("SELECT * FROM `auction_item` WHERE Item_Id = '".$feorder['Item_Id']."'");
            $feitem = $item->fetch();

            $brand = $db->query("SELECT * FROM auction_brand WHERE Brand_Id = '".$feitem['Brand_Id']."'");
            $febrand = $brand->fetch();
            $purchase[$p]["Item_Id"] = $feitem['Item_Id'];
            $purchase[$p]["Item_Name"] = $feitem['Item_Name'];
            $purchase[$p]["Brand_Name"] =($febrand['Brand_Name']) ? $febrand['Brand_Name'] : '';
            $purchase[$p]["Item_FrontPicture"] = $feitem['Item_FrontPicture'] != '' ? $DefaultUrl . $feitem['Item_FrontPicture'] : $feitem['Item_FrontPicture'];
            $purchase[$p]["created"] = $feitem['created'];
            $pa = array();
            $pa["Item_NormalPrice"] = $feitem['Item_NormalPrice'];
            $pa["Item_Condition"] = $feitem['Item_Condition'];
            $pa["Item_Size"] = $feitem['Item_Size'];
            $pa["Item_Box"] = $feitem['Item_Availability'];
            //  $complete=$db->query("SELECT * FROM auction_user_order WHERE  Order_Type != 'TRADE' AND Order_Status = 2 AND Tracking_No2 !='' AND Order_Id ='".$feorder['Order_Id']."' ");
             
            $pa["Is_Order_Complete"] = $feorder['Order_Complete'];
            $pa["Order_Id"] = $feorder['Order_Id'];
           
            $pa["Tracking_No"] = $feorder['Tracking_No2'];
            $pa["Order_On"] = $feorder['created'];
            $purchase[$p]["Order"] = $pa;
            $p++;
        }

        $order = $db->query("SELECT * FROM auction_user_order WHERE Seller_Id = '$User_Id' AND Order_Type != 'TRADE'");
        $sold = array(); $s = 0;
        while ($feorder = $order->fetch()) {
            $item = $db->query("SELECT * FROM `auction_item` WHERE Item_Id = '".$feorder['Item_Id']."'");
            $feitem = $item->fetch();

            $brand = $db->query("SELECT * FROM auction_brand WHERE Brand_Id = '".$feitem['Brand_Id']."'");
            $febrand = $brand->fetch();
            $sold[$s]["Item_Id"] = $feitem['Item_Id'];
            $sold[$s]["Item_Name"] = $feitem['Item_Name'];
            $sold[$s]["Brand_Name"] = ($febrand['Brand_Name']) ? $febrand['Brand_Name'] : '';
            $sold[$s]["Item_FrontPicture"] = $feitem['Item_FrontPicture'] != '' ? $DefaultUrl . $feitem['Item_FrontPicture'] : $feitem['Item_FrontPicture'];
            $sold[$s]["created"] = $feitem['created'];
            $ra = array();
            $ra["Item_NormalPrice"] = $feitem['Item_NormalPrice'];
            $ra["Item_Condition"] = $feitem['Item_Condition'];
            $ra["Item_Size"] = $feitem['Item_Size'];

            $ra["Item_Box"] = $feitem['Item_Availability'];
            $user = $db->query("SELECT * FROM auction_user WHERE User_Id = '" . $feorder['User_Id'] . "' ");
            $feuser = $user->fetch();
            $ra["User_Id"] = $feorder['User_Id'];

            $Paymentpurchase = $db->query("SELECT * FROM user_purchase_item WHERE Order_Id = '".$feorder['Order_Id']."' ");
            $fePaymentpurchase = $Paymentpurchase->fetch();
            if ($fePaymentpurchase['Purchase'] == '0') {
                $ra["Is_ConfirmSale"] = "0";
                $ra["Mark_As_Shipped"] = "0";
            } elseif ($fePaymentpurchase['Purchase'] == '1') {
                $ra["Is_ConfirmSale"] = "1";
                $ra["Mark_As_Shipped"] = "0";
            } elseif ($fePaymentpurchase['Purchase'] == '2') {
                $ra["Is_ConfirmSale"] = "1";
                $ra["Mark_As_Shipped"] = "1";
            }
            $ra["Order_Id"] = $feorder['Order_Id'];
        
            $payment = $db->query("SELECT sum(`Item_NormalPrice`) as total FROM `auction_user_order` WHERE `Seller_Id` = '$User_Id'  GROUP BY `Seller_Id`  ");
            $fepayment = $payment->fetch();
            $ra["Total_Earned"] = $fepayment['total'];
            $ra["Order_On"] = $feorder['created'];
            $sold[$s]["Order"] = $ra;
            $s++;
        }

        $response['success'] = 1;
        $response['Traded'] = $trade;
        $response['Purchased'] = $purchase;
        $response['Sold'] = $sold;
        $response['message'] = "User Item Details";
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
