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
        $Card_Type = $_REQUEST['Card_Type'];
        $Card_Number = $_REQUEST['Card_Number'];
        $Card_ExpDate = $_REQUEST['Card_ExpDate']; 
        $Card_Cvv = $_REQUEST['Card_Cvv'];
        $Card_HolderName= $_REQUEST['Card_HolderName'];
        $Card_HolderAddress= $_REQUEST['Card_HolderAddress'];
        $User_UnitNo= $_REQUEST['User_UnitNo'];
        $User_State= $_REQUEST['User_State'];
        $User_City= $_REQUEST['User_City'];
        $Zip_Code = $_REQUEST['Zip_Code'];
        
        $monthyear = explode("/",$Card_ExpDate);
        
        //verify card here.
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
                //print_r($verify);

                if(isset($verify['id']) && $verify['card']['brand'] != '' && $verify['card']['exp_month'] != '' && $verify['card']['exp_year'] != '' && $verify['card']['funding'] != '')
                {
                    $created = date("Y-m-d H:i:s");
        
                    $user=$db->query("select * from auction_user where User_Id='$User_Id'");
                    $feuser=$user->fetch();

                    if($feuser['User_verified'] == '1')
                    {
                          $response['verified_User'] = $DefaultPath. 'verify.png';
                    }
            
    
                    $insert = $db->query("INSERT INTO `auction_user_card_detail` (User_Id, Card_Type, Card_Number, Card_ExpDate, Card_Cvv, Card_HolderName,Card_HolderAddress,User_UnitNo, User_State,User_City,Zip_Code,created) VALUES 
                                                                            ('$User_Id', '$Card_Type', '$Card_Number', '$Card_ExpDate', '$Card_Cvv', '$Card_HolderName','$Card_HolderAddress','$User_UnitNo','$User_State','$User_City','$Zip_Code','$created')");
                    $myinsert = $db->lastInsertId(); 
                    if($insert)
                    { 
                        $response['success'] = 1; 
                        $response['message'] = "your card details submitted";
                    }
                    else
                    {
                        $response['success'] = 0;
                        $response['message'] = "your card details not submitted";
                    }

                }

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
                  $response["message"] = "Card Is Not Valid!";
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