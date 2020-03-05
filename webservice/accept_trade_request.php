<?php
include "db.php";
include "payment.php";
include "function.php";

header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST")
{
    if(isset($_REQUEST['Trade_Id']) && isset($_REQUEST['User_Id']))
    {
        $response = array();
    
        $Trade_Id = $_REQUEST['Trade_Id'];
        $User_Id = $_REQUEST['User_Id'];
        $modified=date("Y-m-d H:i:s");
        $check = $db->query("SELECT * FROM trade WHERE Trade_Status = '1' AND Trade_Id = '$Trade_Id'");
        if($check->rowCount() == 0):
            
            $payment = tradePayment($Trade_Id,$User_Id);
            if($payment['success'] == 0)
            {
                $response["success"] = 0;
                $response["message"] = $payment['message'];   
                echo json_encode($response);
                die;
            }
            $update = $db->query("UPDATE `trade` SET `Trade_Status`= '1' WHERE Trade_Id = '$Trade_Id'");
            if($update)
            {
                $select = $db->query("SELECT * FROM trade WHERE Trade_Id = '$Trade_Id'");
                $feselect = $select->fetch();
                $update = $db->query("UPDATE `trade` SET `Trade_Status`= '1' WHERE Trade_Id = '$Trade_Id'");
                $order1 = $db->query("INSERT INTO auction_user_order (User_Id,Seller_Id,Item_Id,Items_Id,Order_Type,Order_Status) VALUE('".$feselect['User_Id']."','".$feselect['Receiver_Id']."','$Trade_Id','".$feselect['Item_Id']."','TRADE','1')");
                $orderID1 = $db->lastInsertId();
                $order2 = $db->query("INSERT INTO auction_user_order (User_Id,Seller_Id,Item_Id,Items_Id,Order_Type,Order_Status) VALUE('".$feselect['Receiver_Id']."','".$feselect['User_Id']."','$Trade_Id','".$feselect['have_Item_Id']."','TRADE','1')");
                $orderID2 = $db->lastInsertId();
                $response['success'] = 1;
                if($User_Id == $feselect['User_Id']):
                    $orderID = $orderID1;
                else:
                    $orderID = $orderID2;
                endif;  

                // PUSH NOTIFICATION
                $dataArray=[];
                $dataArray[]=$feselect['User_Id'];
                $dataArray[]=$feselect['Receiver_Id'];  
                $usersData=implode(',', $dataArray);                      
                $getUsers = $db->query("SELECT * FROM auction_user WHERE  User_Id IN ($usersData)");
                $salarBuyers = $getUsers->fetchAll();
                $deviceTokens=[];;
                foreach ($salarBuyers as $key => $salarBuyer) {
                    $deviceTokens[]=$salarBuyer['User_DeviceToken'];                    
                }                

                $title='Trade Request';
                $messageBody = 'Your trade request has been accepted.';
                sendPushNotificationFromAndroidOrIos2($deviceTokens,$title,$messageBody);
                              

                $response['Order_Id'] = $orderID;
                $response['message'] = 'Trade request accepted successfully!';
            }
            else 
            {
                $response['success'] = 0;
                $response['message'] = "Trade not accepted. Please try again.";
            }
        else:
            $response['success'] = 0;
            $response['message'] = "Trade request already accepted.";
        
        endif;
    } 
    else {
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