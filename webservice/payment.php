<?php
include "db.php";
function paymentCharge($userId,$payment,$type){
        global $db;

        $paymentInfo = $db->query("SELECT * FROM User_Stripe_Info WHERE User_Id = '$userId'");
        if($paymentInfo->rowCount() > 0)
        {
            $message = 'Laced userID:'.$userId.' to payment for '.$type;
            require_once('../stripepaymentgateway/init.php');
            $params = array(
                "testmode"  => "on",
                "private_live_key" => "sk_live_dndDG08hdcyh0JcL5b71kPFS",
                "public_live_key"  => "pk_live_xQmpClHOX13I7G7xgCuZ1PKB",
                "private_test_key" => "sk_test_fusISb6VHHH4YNsM1n7nHQpk",
                "public_test_key"  => "pk_test_zAsblhyos8R4Z3XuSz6lAfFz"
            ); 

            if ($params['testmode'] == "on") {
                \Stripe\Stripe::setApiKey($params['private_test_key']);
                $pubkey = $params['public_test_key'];
            } else {
                \Stripe\Stripe::setApiKey($params['private_live_key']);
                $pubkey = $params['public_live_key'];
            } 

            $fePaymentInfo = $paymentInfo->fetch();
            $Ammount = explode('.',$payment);
            $Ammount = ($Ammount[0] * 100) + (($Ammount[1]) ? $Ammount[1] : 0 );
            $charge = \Stripe\Charge::create(array(		 
                "amount" => $Ammount,
                "currency" => "usd",
                "source" => "tok_visa",
                "description" => $message), 
                array("stripe_account" => $fePaymentInfo['Stripe_User_Id']) 	  
            );
            if(isset($charge['balance_transaction'])):
                $response['success'] = 1;
                $response['message'] = $charge['balance_transaction'];
                return $response;
            else:
                $response['success'] = 0;
                $response['message'] = 'Sorry your transaction fail. Please try again.';
                return $response;
            endif;
        }
        else
        {
            $response['success'] = 0;
            $response['message'] = "Please, set the Your Payment Informations.";
            return $response;
        }
}


function paymentRefund($userId,$payment){
    global $db;

    $paymentInfo = $db->query("SELECT * FROM User_Stripe_Info WHERE User_Id = '$userId'");
    if($paymentInfo->rowCount() > 0)
    {
        $message = 'Laced userID:'.$userId.' to Credit to Wallet balance';
        require_once('../stripepaymentgateway/init.php');
        $params = array(
            "testmode"  => "off",
            "private_live_key" => "sk_live_dndDG08hdcyh0JcL5b71kPFS",
            "public_live_key"  => "pk_live_xQmpClHOX13I7G7xgCuZ1PKB",
            "private_test_key" => "sk_test_fusISb6VHHH4YNsM1n7nHQpk",
            "public_test_key"  => "pk_test_zAsblhyos8R4Z3XuSz6lAfFz"
        ); 

        if ($params['testmode'] == "on") {
            \Stripe\Stripe::setApiKey($params['private_test_key']);
            $pubkey = $params['private_test_key'];
        } else {
            \Stripe\Stripe::setApiKey($params['private_live_key']);
            $pubkey = $params['public_test_key'];
        } 

        $fePaymentInfo = $paymentInfo->fetch();
        \Stripe\Stripe::setApiKey($pubkey);
       // $tokenId = $token['id'];
        $Ammount = explode('.',$payment);
        $Ammount = ($Ammount[0] * 100) + (($Ammount[1]) ? $Ammount[1] : 0 );
        $charge = \Stripe\Payout::create(array(		 
            "amount" => $Ammount,
            "currency" => "usd",
            "description" => $message,
            "method" => "instant"), 
            array("stripe_account" => $fePaymentInfo['Stripe_User_Id'])			  
        );
        if(isset($charge['balance_transaction'])):
            $response['success'] = 1;
            $response['message'] = $charge['balance_transaction'];
            return $response;
        else:
            $response['success'] = 0;
            $response['message'] = 'Sorry your transaction fail. Please try again.';
            return $response;
        endif;
    }
    else
    {
        $response['success'] = 0;
        $response['message'] = "Please, set the Your Payment Informations.";
        return $response;
    }
}

function tradePayment($Trade_Id,$User_Id){
    global $db;

    $trade = $db->query("SELECT * FROM trade WHERE Trade_Id = '$Trade_Id'");
    $fetrade = $trade->fetch();

    if($fetrade['User_Id'] == $User_Id):
        $User_Id1 = $fetrade['User_Id'];
        $User_Id2 = $fetrade['Receiver_Id'];
        $Item_Id1 = $fetrade['have_Item_Id'];
        $Item_Id2 = $fetrade['Item_Id'];
        $Arrry2= explode(',',$Item_Id2);
        $ITEM1 = 1;
        $ITEM2 = sizeof($Arrry2);
    else:
        $User_Id1 = $fetrade['Receiver_Id'];
        $User_Id2 = $fetrade['User_Id'];
        $Item_Id1 = $fetrade['Item_Id'];
        $Item_Id2 = $fetrade['have_Item_Id'];
        $Arrry1= explode(',',$Item_Id1);
        $ITEM1 = sizeof($Arrry1);
        $ITEM2 = 1;
    endif;
    $paymentInfo1 = $db->query("SELECT * FROM User_Stripe_Info WHERE User_Id = '$User_Id1'");
    if($paymentInfo1->rowCount() == 0)
    {
        $response['success'] = 0;
        $response['message'] = "Please, set your payment informations.";
        return $response;
    }
    $paymentInfo2 = $db->query("SELECT * FROM User_Stripe_Info WHERE User_Id = '$User_Id2'");
    if($paymentInfo2->rowCount() == 0)
    {
        $response['success'] = 0;
        $response['message'] = "Sorry, Your opposite user payment informations not Set.";
        return $response;
    }
    $fePaymentInfo1 = $paymentInfo1->fetch();
    $fePaymentInfo2 = $paymentInfo2->fetch();

    $admin = $db->query("SELECT * FROM auction_admin WHERE Admin_Id= '1'");
    $feadmin = $admin->fetch();
    $tradeCharge = $feadmin['Trade_Charge'];
    $shippingCharge = $feadmin['Shipping_Charge'];


    $Payment1 = ($ITEM1 * $tradeCharge) + $shippingCharge;
    $Payment2 = ($ITEM2 * $tradeCharge) + $shippingCharge; 


        $message1 = 'Laced userID:'.$User_Id1.' to trade in:'.$Trade_Id;
        $message2 = 'Laced userID:'.$User_Id2.' to trade in:'.$Trade_Id;
        require_once('../stripepaymentgateway/init.php');
        $params = array(
            "testmode"  => "on",
            "private_live_key" => "sk_live_dndDG08hdcyh0JcL5b71kPFS",
            "public_live_key"  => "pk_live_xQmpClHOX13I7G7xgCuZ1PKB",
            "private_test_key" => "sk_test_fusISb6VHHH4YNsM1n7nHQpk",
            "public_test_key"  => "pk_test_zAsblhyos8R4Z3XuSz6lAfFz"
        ); 

        if ($params['testmode'] == "on") {
            \Stripe\Stripe::setApiKey($params['private_test_key']);
            $pubkey = $params['private_test_key'];
        } else {
            \Stripe\Stripe::setApiKey($params['private_live_key']);
            $pubkey = $params['private_live_key'];
        } 
        \Stripe\Stripe::setApiKey($pubkey);


        $Ammount1 = explode('.',$Payment1);
        $Ammount1 = ($Ammount1[0] * 100) + (($Ammount1[1]) ? $Ammount1[1] : 0 );
        $charge1 = \Stripe\Charge::create(array(		 
            "amount" => $Ammount1,
            "currency" => "usd",
            "source" => "tok_visa",
            "description" => $message1), 
            array("stripe_account" => $fePaymentInfo1['Stripe_User_Id']) 		  
        );

        $Ammount2 = explode('.',$Payment2);
        $Ammount2 = ($Ammount2[0] * 100) + (($Ammount2[1]) ? $Ammount2[1] : 0 );
        $charge2 = \Stripe\Charge::create(array(		 
            "amount" => $Ammount2,
            "currency" => "usd",
            "source" => "tok_visa",
            "description" => $message2), 
            array("stripe_account" => $fePaymentInfo2['Stripe_User_Id']) 		  
        );
        if(isset($charge1['balance_transaction']) && isset($charge2['balance_transaction'])):
            $transaction1 = $charge1['balance_transaction'];
            $transaction2 = $charge1['balance_transaction'];
            $Ammount1 = $Ammount1 / 100;
            $Ammount2 = $Ammount2 / 100;
            $db->query("INSERT INTO `auction_payment`( `User_Id`, `Info_Id`, `Info_Type`, `Pyment_Method`, `Payment_TransferNo`, `Payment_Amount`, `Processing_Fees`, `Reward_Price`, `Laced_Creadit`, `Payment_Complete`) VALUES 
            ('$User_Id1','$Trade_Id','Trade','Stripe','$transaction1','$Ammount1','$Ammount1','0','0','1')");
            $db->query("INSERT INTO `auction_payment`( `User_Id`, `Info_Id`, `Info_Type`, `Pyment_Method`, `Payment_TransferNo`, `Payment_Amount`, `Processing_Fees`, `Reward_Price`, `Laced_Creadit`, `Payment_Complete`) VALUES 
            ('$User_Id2','$Trade_Id','Trade','Stripe','$transaction2','$Ammount2','$Ammount2','0','0','1')");
            $response['success'] = 1;
            $response['message'] = 'success';
            return $response;
        else:
            $db->query("UPDATE trade SET is_cancelled = '1' WHERE Trade_Id = '$Trade_Id'");
            if(isset($charge1['balance_transaction'])):
                $charge = \Stripe\Payout::create(array(		 
                    "amount" => $Ammount1,
                    "currency" => "usd",
                    "description" => "Refund to unscessfull trade payment",
                    "method" => "instant"), 
                    array("stripe_account" => $fePaymentInfo1['Stripe_User_Id'])			  
                );
            else:
                $charge = \Stripe\Payout::create(array(		 
                    "amount" => $Ammount2,
                    "currency" => "usd",
                    "description" => "Refund to unscessfull trade payment",
                    "method" => "instant"), 
                    array("stripe_account" => $fePaymentInfo2['Stripe_User_Id'])			  
                );
            endif;
            $response['success'] = 0;
            $response['message'] = 'Sorry your transaction fail. Please try again.';
            return $response;
        endif;
return $response;
}
?>