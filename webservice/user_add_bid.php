<?php
include "db.php";
require_once('payment.php');
header('Content-Type: application/json');
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST"):
    if (isset($_REQUEST['User_Id']) && isset($_REQUEST['Item_Id']) && isset($_REQUEST['Bid_Price'])):
        $response = array();
        $User_Id =  $_REQUEST['User_Id'];
        $Item_Id = $_REQUEST['Item_Id'];
        $Bid_Price = $_REQUEST['Bid_Price'];
        $message = 'Laced userId:'.$User_Id.' Bid to itemId:'.$Item_Id;
        $created = date("Y-m-d H:i:s");
       /* $payment = paymentCharge($User_Id,$Bid_Price,'Product Bid');
        if(isset($payment['success']))
        {
            if($payment['success'] == 1)
            {*/
                $insert = $db->query("INSERT INTO `auction_bid` (User_Id, Item_Id, Bid_Price, created) VALUES   ('$User_Id', '$Item_Id', '$Bid_Price', '$created')");
                $myinsert = $db->lastInsertId();
                if ($insert):
                    $db->query("INSERT INTO `auction_payment`(`User_Id`, `Info_Id`, `Info_Type`, `Pyment_Method`, `Payment_TransferNo`, `Payment_Amount`, `Processing_Fees`,`Reward_Price`, `Laced_Creadit`) VALUES ('$User_Id','$myinsert','Bid','Stripe','".$payment['message']."','$Bid_Price','0','0','0')");
                    $response['Bid_id'] = $myinsert ;
                    $response['success'] = 1;
                    $response['message'] = "Your Bid Place Successfully";
                else:
                    $response['success'] = 0;
                    $response['message'] = "Your Bid Not Place Successfully";
                endif;
           /* }
            else
            {
                $response["success"] = 0;
                $response["message"] = $payment['message'];   
                echo json_encode($response);
                die;
            }
			
        }
        else
        {
            $response["success"] = 0;
            $response["message"] = "Your Payment credential somthing wrong.Please check your payment credential.";
            echo json_encode($response);
            die;
        }*/
    else:
        $response["success"] = 0;
        $response["message"] = "Fields are missing";
    endif;
else:
    $response["success"] = 0;
    $response["message"] = "Invalid Request Type(Use POST Method)";
endif;
echo json_encode($response);
?>