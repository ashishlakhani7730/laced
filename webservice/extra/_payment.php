<?php
include "db.php";
function paymentCharge($userId,$payment,$type){
        global $db;

        $paymentInfo = $db->query("SELECT * FROM user_bank_info WHERE User_Id = '$userId'");
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
                \Stripe\Stripe::setApiKey($params['public_test_key']);
                $pubkey = $params['private_test_key'];
            } else {
                \Stripe\Stripe::setApiKey($params['private_live_key']);
                $pubkey = $params['public_test_key'];
            } 

            $fePaymentInfo = $paymentInfo->fetch();
            if(!empty($fePaymentInfo['Card_No']) && !empty($fePaymentInfo['Expiry_Data']) && !empty($fePaymentInfo['Cvv_Code']))
            {
                try {
                    $dataCard = explode('/',$fePaymentInfo['Expiry_Data']);
                    \Stripe\Stripe::setApiKey($pubkey);
                        $token = \Stripe\Token::create(array(
                        "card" => array(
                        "number" => $fePaymentInfo['Card_No'],
                        "exp_month" => $dataCard[0],
                        "exp_year" => $dataCard[1],
                        "cvc" => $fePaymentInfo['Cvv_Code']
                        )
                    ));
                } catch(\Stripe\Error\Card $e) {
                    $response['success'] = 0;
                    $response['message'] = 'Your card was declined. Please, check your card details.';
                    return $response;
                }
            }
            else
            {
                try {
                    $token = \Stripe\Token::create(array(
                    "bank_account" => array(
                      "country" => 'US',
                      "currency" => 'usd',
                      "routing_number" => $paymentInfo['Routing_Number'],
                      "account_number" => $paymentInfo['Account_Number'],
                      "account_holder_name" => $paymentInfo['Account_HolderName']
                    )
                  ));
                } catch(\Stripe\Error\Card $e) {
                    $response['success'] = 0;
                    $response['message'] = 'Your bank was declined. Please, check your bank details.';
                    return $response;
                }
            }
            $tokenId = $token['id'];
            $Ammount = explode('.',$payment);
            $Ammount = ($Ammount[0] * 100) + (($Ammount[1]) ? $Ammount[1] : 0 );
            $charge = \Stripe\Charge::create(array(		 
                "amount" => $Ammount,
                "currency" => "usd",
                "source" => $tokenId,
                "description" => $message)			  
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

    $paymentInfo = $db->query("SELECT * FROM user_bank_info WHERE User_Id = '$userId'");
    if($paymentInfo->rowCount() > 0)
    {
        $message = 'Laced userID:'.$userId.' to Credit to Wallet balance';
        require_once('../stripepaymentgateway/init.php');
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

        $fePaymentInfo = $paymentInfo->fetch();
        if(!empty($fePaymentInfo['Card_No']) && !empty($fePaymentInfo['Expiry_Data']) && !empty($fePaymentInfo['Cvv_Code']))
        {
            try {
                $dataCard = explode('/',$fePaymentInfo['Expiry_Data']);
                \Stripe\Stripe::setApiKey($pubkey);
                    $token = \Stripe\Token::create(array(
                    "card" => array(
                    "number" => $fePaymentInfo['Card_No'],
                    "exp_month" => $dataCard[0],
                    "exp_year" => $dataCard[1],
                    "cvc" => $fePaymentInfo['Cvv_Code']
                    )
                ));
            } catch(\Stripe\Error\Card $e) {
                $response['success'] = 0;
                $response['message'] = 'Your card was declined. Please, check your card details.';
                return $response;
            }
            $Source = "card";
        }
        else
        {
            try {
                $token = \Stripe\Token::create(array(
                "bank_account" => array(
                  "country" => 'US',
                  "currency" => 'usd',
                  "routing_number" => $paymentInfo['Routing_Number'],
                  "account_number" => $paymentInfo['Account_Number'],
                  "account_holder_name" => $paymentInfo['Account_HolderName']
                )
              ));
            } catch(\Stripe\Error\Card $e) {
                $response['success'] = 0;
                $response['message'] = 'Your bank was declined. Please, check your bank details.';
                return $response;
            }
            $Source = "bank_account";
        }
        $tokenId = $token['id'];
        $Ammount = explode('.',$payment);
        $Ammount = ($Ammount[0] * 100) + (($Ammount[1]) ? $Ammount[1] : 0 );
        $charge = \Stripe\Charge::create(array(		 
            "amount" => $Ammount,
            "currency" => "usd",
            $Source => $tokenId,
            "description" => $message)			  
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
?>