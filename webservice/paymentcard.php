<?php
include "db.php";
require_once('../stripepaymentgateway/init.php');
header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	
			//\Stripe\Stripe::setApiKey("sk_test_fusISb6VHHH4YNsM1n7nHQpk");

			//$allac = \Stripe\Account::all(["limit" => 100]);
			//print_r($allac);exit;
			$response = array();
			$User_Id = $_POST["User_Id"];
			$check = $db->query("SELECT * from auction_user_card_detail WHERE User_Id = '$User_Id'");
		 
			$card = $check->fetch();
			//echo "<pre>";print_r($card); exit;
			$Card_Number = $card["Card_Number"];
			$monthyear = explode("/",$card["Card_ExpDate"]);
			//echo "<pre>";print_r($monthyear);exit;
			$Card_Cvv = $card["Card_Cvv"];
			
				try {
					\Stripe\Stripe::setApiKey($stripeapikey);
					$token = \Stripe\Token::create(array(
					  "card" => array(
						"number" => $Card_Number,
						"exp_month" => $monthyear[0],
						"exp_year" => $monthyear[1],
						"cvc" => $Card_Cvv
					  )
					));

					$verify = $token->jsonSerialize();
					
					\Stripe\Stripe::setApiKey($stripeapikey);
					$charge = \Stripe\Charge::create([
					  "amount" => 5000,
					  "currency" => "usd",
					  "source" => $verify['id'], // obtained with Stripe.js
					  "description" => "Charge for jenny.rosen@example.com"
					]);
			} catch(\Stripe\Error\Card $e) {
					  // Since it's a decline, \Stripe\Error\Card will be caught
					  $body = $e->getJsonBody();
					  $err  = $body['error'];

					  /*print('Status is:' . $e->getHttpStatus() . "\n");
					  print('Type is:' . $err['type'] . "\n");
					  print('Code is:' . $err['code'] . "\n");
					  // param is '' in this case
					  print('Param is:' . $err['param'] . "\n");
					  print('Message is:' . $err['message'] . "\n");*/

					  $response["success"] = 0;
					  $response["message1"] = "Card Is Not Valid!";
					  $response["message_from_strip"] = $err['message'];
			}
		 
		 
}
else
{
	$response["success"] = 0;
	$response["message"] = "Calling method is wrong";
}
echo json_encode($response);
?>