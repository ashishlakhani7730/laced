<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include "db.php";
include "function.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];

if ($REQUEST == "POST")
{
    if(isset($_REQUEST['Order_Id']) && isset($_REQUEST['User_Id']))
    {   
        $Order_Id = $_REQUEST['Order_Id'];
        $order = $db->query("SELECT * FROM auction_user_order WHERE Order_Id = '$Order_Id'");
        
        
        if($order->rowCount() > 0):
            $feorder =  $order->fetch();
            
            $User_Id = $_REQUEST['User_Id'];
            $user = $db->query("SELECT * FROM auction_user WHERE User_Id = '".$feorder['User_Id']."'");
            $feuser = $user->fetch();
            
            $response['success'] = 1;
            if($feorder['Order_Type'] == 'TRADE'):
                $TreadId = $feorder['Item_Id'];
                $response['userDetails'] = $feuser['User_FullName'];
                $trackingDetails['tradeAccepted'] = 1;
                $order_Status = $db->query("SELECT * FROM auction_user_order WHERE Item_Id = '$TreadId' AND Order_Status = '0'");
                $trackingDetails['donePacking'] = $order_Status->rowCount() > 0 ? 0 : 1;
                $trackingDetails['packaging'] =  $order_Status->rowCount() > 0 ? 0 : 1;
                $order_Tracking = $db->query("SELECT * FROM auction_user_order WHERE Item_Id = '$TreadId' AND Tracking_No1 = ''");
                $trackingDetails['shippingLaced'] = $order_Tracking->rowCount() > 0 ? 0 : 1;
                $order_Deliverd = $db->query("SELECT * FROM auction_user_order WHERE Item_Id = '$TreadId' AND Order_Status != '2'");
                $trackingDetails['deliverdLaced'] = $order_Deliverd->rowCount() >  0 ? 0 : 1;
                $trackingDetails['verifiedAuthentic'] = $order_Deliverd->rowCount() > 0 ? 0 : 1;
                
                $order_shippingYou = $db->query("SELECT * FROM auction_user_order WHERE Item_Id = '$TreadId' AND Tracking_No2 = ''");
                $trackingDetails['shippingYou'] = $order_shippingYou->rowCount() >  0 ? 0 : 1;
                 $order_bothDeliver = $db->query("SELECT * FROM auction_user_order WHERE Item_Id = '$TreadId' AND Order_Complete = '0'");
                $trackingDetails['bothDeliver'] =$order_bothDeliver->rowCount() >  0 ? 0 : 1;
                 $order_Complete = $db->query("SELECT * FROM auction_user_order WHERE Item_Id = '$TreadId' AND Order_Complete = '1'");
                $trackingDetails['tradeComplate'] = $order_Complete->rowCount() >  0 ? 0 : 1;
                $response['Tracking_Order'] = $trackingDetails;
            else:
                if($User_Id == $feorder['User_Id']):
                    $response['userDetails'] = 'You';
                else:
                    $response['userDetails'] = $feuser['User_FullName'];
                endif;

                $trackingDetails['ordered'] = 1;
                $update = $db->query("SELECT * FROM  `user_purchase_item` WHERE `Purchase`= '1' AND  User_Id='$User_Id'  AND Item_Id = '" . $feorder['Item_Id'] . "' ");
                $trackingDetails['confirmed'] = $update->rowCount() > 0 ? 1 : 0;
                $trackingDetails['packaging'] = $feorder['Tracking_No1'] != '' ? 1 : 0;
                $trackingDetails['shippingLaced'] = $feorder['Tracking_No1'] != '' ? 1 : 0;
                $trackingDetails['deliverdLaced'] = $feorder['Order_Status'] == 2 ? 1 : 0;
                $trackingDetails['verifiedAuthentic'] = $feorder['Order_Status'] == 2 ? 1 : 0;
                $trackingDetails['shippingYou'] = $feorder['Tracking_No2'] != '' ? 1 : 0;
                $trackingDetails['deliverd'] = $feorder['Order_Complete'] == 1 ? 1 : 0;
                $trackingDetails['complate'] = $feorder['Order_Complete'] == 1 ? 1 : 0;
                $response['Tracking_Order'] = $trackingDetails;
            endif;

            $response['message'] = "Product Traking Details";

        else:
            $response['success'] = 0;
            $response['message'] = "Sorry, but your order details is not found. Please, try again.";
        endif;
    } 
    else
    {
        $response["success"] = 0;
        $response["message"] = "Fields are missing";        
    }
} 
else
{
    $response["success"] = 0;
    $response["message"] = "Invalid Request Type(Use POST Method)";    
}
echo json_encode($response);
?>