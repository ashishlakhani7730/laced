<?php
include "db.php";
require_once('payment.php');
header('Content-Type: application/json');
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST")
{
    if(isset($_REQUEST['User_Id']) && isset($_REQUEST['Seller_Id']) && isset($_REQUEST['Item_Id']) && isset($_REQUEST['Item_Name']) && isset($_REQUEST['Payment_Amount']) && isset($_REQUEST['Processing_Fees']) && isset($_REQUEST['Reward_Price']) && isset($_REQUEST['Laced_Creadit']))
    {
        $response = array();
        $User_Id = $_REQUEST['User_Id'];
       	$Seller_Id = $_REQUEST['Seller_Id'];
        $Item_Id = $_REQUEST['Item_Id'];
        $Item_Name = $_REQUEST['Item_Name'];
        $Payment_Amount = $_REQUEST['Payment_Amount'];
        $Processing_Fees = $_REQUEST['Processing_Fees'];
        $Reward_Price = $_REQUEST['Reward_Price'];
        $Laced_Creadit = $_REQUEST['Laced_Creadit'];
        $message = 'Laced Product Purces '.$Item_Name;
        $payment = array();
        $walletID = '';
        if($Laced_Creadit > 0)
        {
            $wallet = $db->query("SELECT * FROM wallet_ledger WHERE User_Id = '$User_Id' ORDER BY Wallet_Id DESC");
            $fewallet = $wallet->fetch();
            $Wallet_Post_Balance = '-'.$Laced_Creadit;
            $Wallet_Current_Balance = $fewallet['Wallet_Current_Balance'] - $Laced_Creadit;
            $walletMessage = 'Laced '.$Item_Name.' Product Purched';
            $insertWallet = $db->query("INSERT INTO `wallet_ledger`(`User_Id`, `Wallet_Pre_Balance`, `Wallet_Post_Balance`, `Wallet_Current_Balance`, `Message`) VALUES
             ('$User_Id','".$fewallet['Wallet_Current_Balance']."','$Wallet_Post_Balance','$Wallet_Current_Balance','$walletMessage')");
            $walletID = $db->lastInsertId();
            $db->query("UPDATE auction_user SET wallet_balance = '$Wallet_Current_Balance' WHERE User_Id = '$User_Id'");
        }
        if($Payment_Amount > 0){
            $payment = paymentCharge($User_Id,$Payment_Amount,'Product Instaby Purches');
        }else{
            
            $payment['success'] = '1';
            $payment['message'] = $walletID;
        }
        if(isset($payment['success']))
        {
            if($payment['success'] == 1)
            {   $select = $db->query("SELECT * from auction_item WHERE Item_Id = '$Item_Id'");
                $feselect = $select->fetch();
                $insert = $db->query("INSERT INTO `auction_user_order` (Seller_Id,User_Id, Item_Id, Item_Name, Item_NormalPrice, Order_Type,Order_Status) VALUES ('$Seller_Id','$User_Id', '$Item_Id', '$Item_Name', '".$feselect['Item_NormalPrice']."','INSTANBY','1')");
                $orderID = $db->lastInsertId();
                
                $db->query("INSERT INTO `user_purchase_item` (Order_Id,Seller_Id,User_Id,Item_Id, Purchase, created) VALUES ('$orderID','$Seller_Id','$User_Id','$Item_Id', '0','$todaydate')");
                
                $Popularity = $feselect['Popularity'] + 1;
                $db->query("UPDATE auction_item SET Popularity = $Popularity WHERE Item_Id = '$Item_Id'");
                
                $user=$db->query("SELECT * from auction_user WHERE User_Id = '$Seller_Id'");
                $feuser=$user->fetch();
                $db->query("INSERT INTO `auction_payment`(`User_Id`, `Info_Id`, `Info_Type`, `Pyment_Method`, `Payment_TransferNo`, `Payment_Amount`,
                    `Processing_Fees`,`Reward_Price`, `Laced_Creadit`) VALUES ('$User_Id','$orderID','Instaby','Stripe','".$payment['message']."','$Payment_Amount','$Processing_Fees','$Reward_Price','$Laced_Creadit')");
                $response['Order_Number']= $orderID;
                $response['Total_Price']= $Payment_Amount;
                $response['Condition']= $feselect['Item_Condition'];
                $response['Box']= $feselect['Item_Availability'];
                $response['Size']= $feselect['Item_Size'];
                $response['Seller']= $feuser['User_Name'];
                $response['success'] = 1;               
                $response['message'] = "Your Order Confirmed Successfully.";
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