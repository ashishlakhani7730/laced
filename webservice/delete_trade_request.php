<?php

include "db.php";

include "function.php";

header('Content-Type: application/json');

$checkFields = "";

$REQUEST = $_SERVER['REQUEST_METHOD'];

if ($REQUEST == "POST")

{

        if(isset($_REQUEST['Trade_Id']))

        {

            $Trade_Id = $_REQUEST['Trade_Id'];
            $response = array();

            $check = $db->query("SELECT * FROM auction_user_order WHERE Item_Id = '$Trade_Id' AND Order_Type = 'TRADE' AND Tracking_No1 != ''");
            $getTradDetails = $check->fetch();            
           
            if($check->rowCount() > 0):

                $Trade_Id = $_REQUEST['Trade_Id'];

                $del_request = $db->query("DELETE FROM `trade` WHERE Trade_Id = '$Trade_Id'");



                if($del_request->rowCount())

                {

                        // PUSH NOTIFICATION
                        $dataArray=[];
                        $dataArray[]=$getTradDetails['User_Id'];
                        $dataArray[]=$getTradDetails['Seller_Id'];  
                        $usersData=implode(',', $dataArray);                      
                        $getUsers = $db->query("SELECT * FROM auction_user WHERE  User_Id IN ($usersData)");
                        $salarBuyers = $getUsers->fetchAll();
                        $deviceTokens=[];;
                        foreach ($salarBuyers as $key => $salarBuyer) {
                            $deviceTokens[]=$salarBuyer['User_DeviceToken'];                    
                        }                

                        $title='Trade Request';
                        $messageBody = 'Your trade request has been reject.';
                        sendPushNotificationFromAndroidOrIos2($deviceTokens,$title,$messageBody);
                              

                        $response['success'] = 1;

                        $response['message'] = 'Trade Request Decline Successfully!';

                }

                else 

                {

                        $response['success'] = 0;

                        $response['message'] = "Somthing Went to Wrong In Decline Request";

                }

            else:

                $response['success'] = 0;

                $response['message'] = "Order is Shipped. so you don't delete order.";

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