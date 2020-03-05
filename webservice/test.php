<?php
include "db.php";
require_once('../stripepaymentgateway/init.php');
header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	//\Stripe\Stripe::setApiKey("sk_test_fusISb6VHHH4YNsM1n7nHQpk");

	//$bal = \Stripe\Payout::all();
	//print_r($bal);
	$userId = $_POST['userId'];
	$paymentInfo = $db->query("SELECT * FROM User_Stripe_Info WHERE User_Id = '$userId'");
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
            \Stripe\Stripe::setApiKey($params['private_test_key']);
            $pubkey = $params['private_test_key'];
        } else {
            \Stripe\Stripe::setApiKey($params['private_live_key']);
            $pubkey = $params['public_test_key'];
        } 

        $fePaymentInfo = $paymentInfo->fetch();
        \Stripe\Stripe::setApiKey($pubkey);
       // $tokenId = $token['id'];
        //$Ammount = explode('.',$payment);
        $Ammount = (100 * 100);
       // $check_balnace = \Stripe\Balance::retrieve();
//$balanceArr = $check_balnace->__toArray(true);
//$available_amount = $balanceArr['available']['0']['amount'];
//echo $available_amount;

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
else
{
	$response["success"] = 0;
	$response["message"] = "Calling method is wrong";
}
echo json_encode($response);
?>