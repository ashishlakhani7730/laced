<?php
include "db.php";
require_once('payment.php');
header('Content-Type: application/json');
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") 
{
    if (isset($_REQUEST['Raffle_Id']) && isset($_REQUEST['User_Id']) && isset($_REQUEST['Item_Id']) && isset($_REQUEST['Raffle_Price']) ) {
        $response = array();
        $Raffle_Id = $_REQUEST['Raffle_Id'];
        $User_Id= $_REQUEST['User_Id'];
        $Item_Id = $_REQUEST['Item_Id'];
        $Raffle_Price= $_REQUEST['Raffle_Price'];
        $message = 'Laced userId:'.$User_Id.' Raffel to raffleId:'.$Raffle_Id;
        $payment = paymentCharge($User_Id,$Raffle_Price,'Product Raffel');
        if(isset($payment['success']))
        {
            if($payment['success'] == 1)
            {
                $insert = $db->query("INSERT INTO `raffle_user` (Raffle_Id,User_Id,Item_Id,Raffle_Price,Raffle_Status) VALUES ('$Raffle_Id','$User_Id', '$Item_Id', '$Raffle_Price','1' )");
                $myinsert = $db->lastInsertId();
                if ($insert):
                    $db->query("INSERT INTO `auction_payment`(`User_Id`, `Info_Id`, `Info_Type`, `Pyment_Method`, `Payment_TransferNo`, `Payment_Amount`, `Processing_Fees`,`Reward_Price`, `Laced_Creadit`) VALUES ('$User_Id','$myinsert','Raffel','Stripe','".$payment['message']."','$Raffle_Price','0','0','0')");
                    $response['success'] = 1;
                    $response['message'] = "Your Raffle Place Successfully";
                else:
                    $response['success'] = 0;
                    $response['message'] = "Your Raffle Not Place Successfully";
                endif;
            }
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