<?php
include "db.php";
include "function.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") {
    if (isset($_REQUEST['Order_Id']) && isset($_REQUEST['Type']) && isset($_REQUEST['Tracking_No']) && isset($_REQUEST['Courier_Name'])) {

        $response = array();

        $Tracking_No= $_REQUEST['Tracking_No']; 
        $Type = $_REQUEST['Type'];
        $Order_Id = $_REQUEST['Order_Id'];
        $Courier_Name = $_REQUEST['Courier_Name'];
        if ($Type == 'Confirm') {
            $Order = $db->query("SELECT * FROM auction_user_order WHERE  Order_Id='$Order_Id' ");
            $feOrder = $Order->fetch();
            $update = $db->query("UPDATE `user_purchase_item` SET `Purchase`= '1' WHERE  User_Id='" . $feOrder['User_Id'] . "'  AND Item_Id = '" . $feOrder['Item_Id'] . "' ");
            if ($update) {

                $dataArray=[];
                $dataArray[]=$feOrder['User_Id'];
                $dataArray[]=$feOrder['Seller_Id'];  
                $usersData=implode(',', $dataArray);             
                $getUsers = $db->query("SELECT * FROM auction_user WHERE  User_Id IN ($usersData)");
                $salarBuyers = $getUsers->fetchAll();
                $deviceTokens=[];;
                foreach ($salarBuyers as $key => $salarBuyer) {
                    $deviceTokens[]=$salarBuyer['User_DeviceToken'];                    
                }                  
                $title='Product Confirmation';
                $messageBody = 'Thank you for, Confirm to Laced Order';
                sendPushNotificationFromAndroidOrIos2($deviceTokens,$title,$messageBody);

                $response['success'] = 1;
                $response['message'] = "Thank you for, Confirm to Laced Order";
            } else {
                $response['success'] = 0;
                $response['message'] = "Order not Confirmed. Please try again.";
            }
        } else if ($Type == 'Shipped') {

            $url = "https://secure.shippingapis.com/ShippingAPI.dll";
            $service = "TrackV2";
            $xml = rawurlencode("
            <TrackRequest USERID='538LACED2174'>
                <TrackID ID='".$Tracking_No."'></TrackID>
                </TrackRequest>");
            $request = $url . "?API=" . $service . "&XML=" . $xml;
            // send the POST values to USPS
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$request);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPGET, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // parameters to post
            $trackingresult = curl_exec($ch);
            curl_close($ch);

            $trackingresult = new SimpleXMLElement($trackingresult);
            
            if(empty($trackingresult->TrackInfo->TrackDetail)){  
                $response["success"] = 0;
                $response["message"] = "Sorry, Tracking Number is invalid. Please,try again.";
                echo json_encode($response);
                die;
            }
            $Order = $db->query("SELECT * FROM auction_user_order WHERE  Order_Id='$Order_Id' ");
            $feOrder = $Order->fetch();
            $db->query("UPDATE auction_user_order SET Tracking_No1 = '$Tracking_No',Courier_Name = '$Courier_Name' WHERE Order_Id='$Order_Id'");
            $update = $db->query("UPDATE `user_purchase_item` SET `Purchase`= '2' WHERE  User_Id='" . $feOrder['User_Id'] . "'  AND Item_Id = '" . $feOrder['Item_Id'] . "' ");
            if ($update) {

                $dataArray=[];
                $dataArray[]=$feOrder['User_Id'];
                $dataArray[]=$feOrder['Seller_Id'];  
                $usersData=implode(',', $dataArray);             
                $getUsers = $db->query("SELECT * FROM auction_user WHERE  User_Id IN ($usersData)");
                $salarBuyers = $getUsers->fetchAll();
                $deviceTokens=[];;
                foreach ($salarBuyers as $key => $salarBuyer) {
                    $deviceTokens[]=$salarBuyer['User_DeviceToken'];                    
                }    
                $title='Shippment Confirmation';
                $messageBody = 'Your Item Shipped Successfully.';
                sendPushNotificationFromAndroidOrIos2($deviceTokens,$title,$messageBody);

                $response['success'] = 1;
                $response['message'] = "Item Shipped";
            } else {
                $response['success'] = 0;
                $response['message'] = "Item Not Shipped";
            }
        } else {
            $response['success'] = 0;
            $response['message'] = "Type is invalid";
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

