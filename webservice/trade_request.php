<?php
include "db.php";
include "function.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST")
{
    if(isset($_REQUEST['User_Id']) && isset($_REQUEST['Receiver_Id'])  && isset($_REQUEST['Item_Id']) && isset($_REQUEST['Type']) && isset($_REQUEST['have_item_id']))
    {
        $response = array();
    
        $User_Id = $_REQUEST['User_Id'];
        $Receiver_Id = $_REQUEST['Receiver_Id'];
        $Item_Id = $_REQUEST['Item_Id'];
        $Type = $_REQUEST['Type'];
        $have_item_id = $_REQUEST['have_item_id'];
        $created=date("Y-m-d H:i:s");
        if($Type == 'Send')
        {
            $check = $db->query("SELECT * from trade WHERE User_Id = '$Receiver_Id' AND Receiver_Id = '$User_Id' AND Item_Id = '$Item_Id' AND have_Item_Id = '$have_item_id' AND Trade_Status ='0'");
            if($check->RowCount() > 0)
            {
                $response["success"] = 0;
                $response["message"] = "Trade Request already sended. Please, try again.";

                $getItemUser = $db->query("SELECT * FROM auction_user WHERE User_Id='$Receiver_Id'");
                $userData = $getItemUser->fetch();
                $userDeviceToken = $userData['User_DeviceToken'];
                $userDeviceType = $userData['User_DeviceType'];                    
                $message = 'Trade request is already send.';                  
                sendPushNotificationFromAndroidOrIos1($userDeviceToken,'Trad Request',$message,'',$userDeviceType);

            }
            else
            {
                $insert = $db->query("INSERT INTO `trade`(`User_Id`, `Receiver_Id`, `have_item_id`,`Item_Id`, `created`) VALUES ('$Receiver_Id','$User_Id','$have_item_id','$Item_Id','$created')");
                if($insert):                
                    $response["success"] = 1;
                    $response["message"] = "Trade Request send successfully";

                    $getSenderUser = $db->query("SELECT * FROM auction_user WHERE User_Id='$User_Id'");
                    $sendUserData = $getSenderUser->fetch();

                    $getItemUser = $db->query("SELECT * FROM auction_user WHERE User_Id='$Receiver_Id'");
                    $userData = $getItemUser->fetch();
                    $userDeviceToken = $userData['User_DeviceToken'];
                    $userDeviceType = $userData['User_DeviceType'];                    
                    $message = $sendUserData['User_FullName'].' has send trade to you.';                  
                    sendPushNotificationFromAndroidOrIos1($userDeviceToken,'Trad Request',$message,'',$userDeviceType);

                else:
                    $response["success"] = 1;
                    $response["message"] = "Trade Request not sended. Please, try again.";
                endif;
            }
        }
        else
        {
            $response["success"] = 0;
            $response["message"] = "Type is wrong";
        }
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
