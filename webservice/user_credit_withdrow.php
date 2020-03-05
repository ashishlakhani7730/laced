<?php
include "db.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
require_once('../stripepaymentgateway/init.php');
if ($REQUEST == "POST")
{
    if(isset($_REQUEST['User_Id']) && isset($_REQUEST['Ammount']))
    {
        $response = array();
        $User_Id = $_REQUEST['User_Id'];
        $Ammount = $_REQUEST['Ammount'];
        $message = 'Laced Credit Withdrow';
        $user = $db->query("SELECT * FROM auction_user WHERE User_Id = '$User_Id'");
        $feuser = $user->fetch();
        if($feuser['wallet_balance'] >= 100 && $feuser['wallet_balance'] >= $Ammount):
                $refund = paymentRefund($User_Id,$Ammount);
                if(isset($refund['success']))
                {
                    if($payment['success'] == 1)
                    {  
                        $newBalance = $feuser['wallet_balance'] - $Ammount;
                        $db->query("UPDATE auction_user SET wallet_balance = '$newBalance' WHERE User_Id = 'User_Id'");

                        $wallet = $db->query("SELECT * FROM wallet_ledger WHERE User_Id ='$User_Id' ORDER BY Wallet_Id DESC");
                        $fewallet = $wallet->fetch();

                        $Wallet_Post_Balance = '-'.$Ammount;
                        $preBalnce = $fewallet['Wallet_Current_Balance'] - $Ammount;

                        $db->query("INSERT wallet_ledger( User_Id,Wallet_Pre_Balance,Wallet_Post_Balance,Wallet_Current_Balance,Message)VALUES ('$User_Id','".$fewallet['Wallet_Current_Balance']."','$Wallet_Post_Balance','$preBalnce','Credit Withdrow your accounts')");
                        $response['success'] = 1;
                        $response['message'] = "Your Wallet balance Sucessfully transfer in your account.";
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
        else:
            if($feuser['wallet_balance'] < $Ammount):
                $response['success'] = 0;
                $response['message'] = "Sorry, Your Account is only available Balance is $".$feuser['wallet_balance'];
            else:
                $response['success'] = 0;
                $response['message'] = "Sorry, Minimum $100 Creadit requried in your account.";
            endif;
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