<?php

include "db.php";
include "function.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") {

    if (isset($_REQUEST['User_Id']) && isset($_REQUEST['Item_Id']) && isset($_REQUEST['Payment'])) {

        $response = array();
        $User_Id = $_REQUEST['User_Id'];
        $Item_Id = $_REQUEST['Item_Id'];
        $Payment = $_REQUEST['Payment'];
        $date = date("Y-m-d H:i:s");

        $user = $db->query("SELECT * FROM auction_user WHERE User_Id = '$User_Id'");
        $feuser = $user->fetch();
        $rewardID = $rewardPrice = 0;
        $Reward = $db->query("SELECT * FROM reward WHERE Reward_Id = '".$feuser['User_Reward']."'");
        $Fereward=$Reward->fetch();
       
        if(!empty($feuser['User_Reward']) && $Fereward['Minimum_Price']<$Payment){
           
            $reward = $db->query("SELECT * FROM reward WHERE Reward_Id = '".$feuser['User_Reward']."'");
            if($reward->rowCount() > 0){
                $fereward = $reward->fetch();
                $rewardID = $fereward['Reward_Code'];
                if($fereward['Price_Type'] == 'Fixed' ){
                    $rewardPrice = $fereward['Price'];
                }
                else{
                    $rewardPrice = round((($Payment / 100 ) * $fereward['Price']),2);
                }
            }
        }
       
        $admin = $db->query("SELECT * FROM auction_admin WHERE Admin_Id = '1'");
        $feadmin = $admin->fetch();
        
        $Percentage = $Fixed = 0;
        if($feadmin['Processing_Free_Percentage'] > 0){
            $Percentage = $feadmin['Processing_Free_Percentage'].'%';
            $Percentage1 = round((($Payment / 100 ) * $feadmin['Processing_Free_Percentage']),2);
        }
        if($feadmin['Processing_Free_Fixed'] > 0){
            $array = explode('.',$feadmin['Processing_Free_Fixed']);
            $Fixed = $array[0] > 0 ? $feadmin['Processing_Free_Fixed'].'$' : $feadmin['Processing_Free_Fixed'].'¢';
            $Fixed1 = $feadmin['Processing_Free_Fixed'];
        }
        
        $processingLabel = $Percentage > 0 ? ($Fixed > 0 ? $Percentage.' + '.$Fixed : $Percentage)  : ($Fixed > 0 ? $Fixed : 0);
        $processing = $Percentage1 + $Fixed1;

        $walletBalance = 0;
        $totalPrice = round(($Payment + $feadmin['Shipping_Charge'] + $processing - $rewardPrice),2);
        if($feuser['wallet_balance'] > 0)
        {
            if($totalPrice > $feuser['wallet_balance'] )
            {
                $walletBalance = $feuser['wallet_balance'];
                $totalPrice = $totalPrice - $feuser['wallet_balance'];
            }
            else
            {
                $totalPrice = 0;
                $walletBalance = $totalPrice;
            }
        }
        $response["success"] = 1;
        $response["Item_Price"] = $Payment;
        $response["Shipping_Cost"] = $feadmin['Shipping_Charge'];
        $response["Processing_Fees_Label"] = $processingLabel;
        $response["Processing_Fees"] = $processing;
        $response["Reward_Code"] = $rewardID;
        $response["Reward_Price"] = $rewardPrice;
        $response["Laced_Creadit"] = $walletBalance;
        $response["Your_Total"] = $totalPrice;
        $response["message"] = "Item Payment";
        
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
