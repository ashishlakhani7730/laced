<?php
include "db.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
require_once('../stripepaymentgateway/init.php');
if ($REQUEST == "POST")
{
    if(isset($_REQUEST['Seller_Id']) && isset($_REQUEST['User_Id']) && isset($_REQUEST['Item_Id']) && isset($_REQUEST['Item_Name']) && isset($_REQUEST['Item_NormalPrice']) )
    {
        $response = array();
       	$Seller_Id = $_REQUEST['Seller_Id'];
        $User_Id = $_REQUEST['User_Id'];
        $Item_Id = $_REQUEST['Item_Id'];
        $Item_Name = $_REQUEST['Item_Name'];
        $Item_NormalPrice = $_REQUEST['Item_NormalPrice'];
        $message = 'Laced Product Purces '.$Item_Name;
        $payment = $db->query("SELECT * FROM user_bank_info WHERE User_Id = '$User_Id'");
        if($payment->rowCount() > 0):
            $fepayment = $payment->fetch();
            $dataCard = explode('/',$fepayment['Expiry_Data']);
            try {
                $Ammount = explode('.',$Item_NormalPrice);
                $Ammount = ($Ammount[0] * 100) + (($Ammount[1]) ? $Ammount[1] : 0 );
                
                $params = array(
                    "testmode"  => "on",
                    "private_live_key" => "sk_live_dndDG08hdcyh0JcL5b71kPFS",
                    "public_live_key"  => "pk_live_xQmpClHOX13I7G7xgCuZ1PKB",
                    "private_test_key" => "sk_test_fusISb6VHHH4YNsM1n7nHQpk",
                    "public_test_key"  => "pk_test_zAsblhyos8R4Z3XuSz6lAfFz"
                ); 
    
                if ($params['testmode'] == "on") {
                    \Stripe\Stripe::setApiKey($params['public_test_key']);
                    $pubkey = $params['private_test_key'];
                } else {
                    \Stripe\Stripe::setApiKey($params['private_live_key']);
                    $pubkey = $params['public_test_key'];
                } 
                
                \Stripe\Stripe::setApiKey($pubkey);
                    $token = \Stripe\Token::create(array(
                    "card" => array(
                    "number" => $fepayment['Card_No'],
                    "exp_month" => $dataCard[0],
                    "exp_year" => $dataCard[1],
                    "cvc" => $fepayment['Cvv_Code']
                   )
                 ));

                // $token1 = \Stripe\Token::create(array(
                //     "bank_account" => array(
                //       "country" => 'US',
                //       "currency" => 'usd',
                //       "routing_number" => $fepayment['Routing_Number'],
                //       "account_number" => $fepayment['Account_Number'],
                //       "account_holder_name" => $fepayment['Account_HolderName']
                //     )
                //   ));
                $tokenId = $token['id'];
                $charge = \Stripe\Charge::create(array(		 
                    "amount" => $Ammount,
                    "currency" => "usd",
                    "source" => $tokenId,
                    "description" => $message)			  
                );
                $transactionNo = $charge['balance_transaction'];
            } catch(\Stripe\Error\Card $e) {
                $response['success'] = 0;
                $response['message'] = 'Your card was declined. Please, check your card details.';
                echo json_encode($response);
                die;
            }
            $insert = $db->query("INSERT INTO `auction_user_order` (Seller_Id,User_Id, Item_Id, Item_Name, Item_NormalPrice, Order_Type,Order_Status) VALUES ('$Seller_Id','$User_Id', '$Item_Id', '$Item_Name', '$Item_NormalPrice','INSTANBY','1')");
            $orderID = $db->lastInsertId();
            
            $db->query("INSERT INTO `user_purchase_item` (Order_Id,Seller_Id,User_Id,Item_Id, Purchase, created) VALUES ('$orderID','$Seller_Id','$User_Id','$Item_Id', '0','$todaydate')");
            
            $db->query("INSERT INTO auction_payment (User_Id,Order_Id,Pyment_Method,Payment_Amount,Payment_RefrenceNumber,Payment_Type,created) VALUES ('$User_Id','$orderID','card','$Item_NormalPrice','$transactionNo','stripe','$todaydate')");
            $select=$db->query("SELECT * from auction_item WHERE Item_Id = '$Item_Id'");
            $feselect=$select->fetch();
            $Popularity=$feselect['Popularity'] + 1;
            $db->query("update auction_item set Popularity = $Popularity where Item_Id = '$Item_Id'");

            $user=$db->query("SELECT * from auction_user WHERE User_Id = '$User_Id'");
            $feuser=$user->fetch();
            if($insert)
            { 
                $response['Order_Number']= $orderID;
                $response['Total_Price']= $Item_NormalPrice;
                $response['Condition']= $feselect['Item_Condition'];
                $response['Box']= $feselect['Item_Availability'];
                $response['Size']= $feselect['Item_Size'];
                $response['Seller']= $feuser['User_Name'];
                $response['success'] = 1;               
                $response['message'] = "Your Order Confirmed Successfully.";
            }
            else
            {
                $response['success'] = 0;
                $response['message'] = "Your Order Not Confirmed. Please, try again.";
            } 

        else:
            $response['success'] = 0;
            $response['message'] = "Please, set the Your Payment Informations.";
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