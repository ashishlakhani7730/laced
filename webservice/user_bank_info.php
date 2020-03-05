<?php
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
require_once('../stripepaymentgateway/init.php');
if ($REQUEST == "POST")
{
    if(isset($_REQUEST['User_Id']))
    {
        $response = array();
        include "db.php";
  
        $User_Id = $_REQUEST['User_Id'];
        $Bank_HolderName= $_REQUEST['Bank_HolderName'];
        $DOB = $_REQUEST['DOB'];
        $Address = $_REQUEST['Address']; 
        $User_UnitNo= $_REQUEST['User_UnitNo'];
        $User_State = $_REQUEST['User_State'];
        $SSN4 = $_REQUEST['SSN4'];
        $Routing_Number = $_REQUEST['Routing_Number'];
        $Account_Number = $_REQUEST['Account_Number'];
        $created = date("Y-m-d H:i:s");
        
        $user=$db->query("select * from auction_user where User_Id='$User_Id'");
        $feuser=$user->fetch();

        if($feuser['User_verified'] == '1')
        {
              $response['verified_User'] = $DefaultPath. 'verify.png';
        }
        
		try{   
				\Stripe\Stripe::setApiKey($stripeapikey);

				$token = \Stripe\Token::create([
				  "bank_account" => [
					"country" => "US",
					"currency" => "usd",
					"account_holder_name" => $Bank_HolderName,
					"account_holder_type" => "individual",
					"routing_number" => $Routing_Number,      // "110000000",
					"account_number" => $Account_Number       //"000123456789"
				  ]
				]);

			   $verify = $token->jsonSerialize();
				
			   if(isset($verify['id']) && $verify['bank_account'] != "" && $verify['bank_account']['routing_number'] != "")
			   {
				   $insert = $db->query("INSERT INTO `auction_user_bank_info` (User_Id, Bank_HolderName, DOB, Address, User_UnitNo , User_State,SSN4,Routing_Number, Account_Number,created) VALUES 
																				('$User_Id', '$Bank_HolderName', '$DOB', '$Address', '$User_UnitNo', '$User_State','$SSN4','$Routing_Number','$Account_Number','$created')");
					$myinsert = $db->lastInsertId(); 
				   if($insert)
					{ 
						$response['success'] = 1;               
						$response['message'] = "your bank details submitted";
					}
					else
					{
						$response['success'] = 0;
						$response['message'] = "your bank details not submitted";
					} 
			   }
        }catch(\Stripe\Error\Card $e) {
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