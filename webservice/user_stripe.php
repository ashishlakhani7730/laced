<?php
include "db.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST")
{
    if(isset($_REQUEST['User_Id']) && isset($_REQUEST['Authorization_Code']))
    {
        $response = array();
  	    $User_Id= $_REQUEST['User_Id'];
        $Authorization_Code = $_REQUEST['Authorization_Code'];
        $created = date("Y-m-d H:i:s");

       
   
        $url = 'https://connect.stripe.com/oauth/token';
        $mainArray =[];
        $mainArray['client_secret'] = 'sk_test_fusISb6VHHH4YNsM1n7nHQpk';
        $mainArray['code'] = $Authorization_Code;
        $mainArray['grant_type'] = 'authorization_code';

        $fields  =(Object)$mainArray;
        $fields_string = json_encode($fields);
        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);          
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
                    array('Content-Type:application/json',
                        'Content-Length: ' . strlen($fields_string))
                    );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //execute post
        $result = curl_exec($ch);
       // $result = array("access_token"=> "ACCESS_TOKEN","livemode"=> false,"refresh_token"=> "REFRESH_TOKEN","token_type"=> "bearer","stripe_publishable_key"=> "PUBLISHABLE_KEY", "stripe_user_id"=> "ACCOUNT_ID","scope"=> "express");
       //$result = '{"access_token": "ACCESS_TOKEN","livemode": false,"refresh_token": "REFRESH_TOKEN","token_type": "bearer","stripe_publishable_key": "PUBLISHABLE_KEY","stripe_user_id": "ACCOUNT_ID","scope": "express"}';
        $result = json_decode($result);
        //close connection
        curl_close($ch);
        if(isset($result->stripe_user_id))
        {
            $Stripe_User_Id = $result->stripe_user_id;
            $Refresh_Token = $result->refresh_token;
            $Stripe_Publishable_Key = $result->stripe_publishable_key;
            $Access_Token = $result->access_token;
            $check = $db->query("SELECT * FROM User_Stripe_Info WHERE User_Id = '$User_Id'");
            if($check->rowCount() > 0 )
            {
                $db->query("UPDATE User_Stripe_Info SET Stripe_User_Id = '$Stripe_User_Id',Refresh_Token = '$Refresh_Token',Stripe_Publishable_Key = '$Stripe_Publishable_Key',Access_Token = '$Access_Token' WHERE User_Id = '$User_Id'");
            }
            else
            {
                $db->query("INSERT INTO User_Stripe_Info (User_Id,Stripe_User_Id,Refresh_Token,Stripe_Publishable_Key,Access_Token) VALUE('$User_Id','$Stripe_User_Id','$Refresh_Token','$Stripe_Publishable_Key','$Access_Token')");
            }
            $response["success"] = 1;
            $response["message"] = "Your billing and payout information has been successfully setup";  
        }
        else
        {
            $response["success"] = 0;
            $response["message"] = "Sorry, Your authorization code is expired Please try again.";  
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