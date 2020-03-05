<?php
 include "db.php";
header('Content-Type: application/json');
$REQUEST = $_SERVER['REQUEST_METHOD'];
require_once('../stripepaymentgateway/init.php');
if ($REQUEST == "POST")
{
    if(isset($_REQUEST['User_Id']) && isset($_REQUEST['BanInfo_Type']) && isset($_REQUEST['Bank_Name']) && isset($_REQUEST['Account_Number']) && isset($_REQUEST['Routing_Number']) && isset($_REQUEST['Date_of_Birth']) && isset($_REQUEST['Account_HolderName']) && isset($_REQUEST['Card_No']) && isset($_REQUEST['Expiry_Data']) && isset($_REQUEST['Cvv_Code']))
    {
        $response = array();
        $User_Id = $_REQUEST['User_Id'];
        $BanInfo_Type= $_REQUEST['BanInfo_Type'];
        $Bank_Name = $_REQUEST['Bank_Name'];
        $Account_Number = $_REQUEST['Account_Number']; 
        $Routing_Number= $_REQUEST['Routing_Number'];
        $Date_of_Birth = $_REQUEST['Date_of_Birth'];
        $Account_HolderName = $_REQUEST['Account_HolderName'];
        $Card_No = $_REQUEST['Card_No'];
        $Expiry_Data = $_REQUEST['Expiry_Data'];
        $Cvv_Code = $_REQUEST['Cvv_Code'];
        
        if($BanInfo_Type == 'Bank'):
            stream_context_set_default(['ssl' => ['verify_peer' => false,'verify_peer_name' => false,],]);
            $url = file_get_contents('https://www.routingnumbers.info/api/data.json?rn='.$Routing_Number);
            $response_a = json_decode($url,true);
            if($response_a['message'] != 'OK'):
                $response['success'] = 0;
                $response['message'] = 'Your Bank Details is Wrong. Please, check your bank details.';
                echo json_encode($response);
                die;
            endif;
        elseif($BanInfo_Type == 'Card'):
            $params = array(
                "testmode"  => "on",
                "private_live_key" => "sk_live_dndDG08hdcyh0JcL5b71kPFS",
                "public_live_key"  => "pk_live_xQmpClHOX13I7G7xgCuZ1PKB",
                "private_test_key" => "sk_test_fusISb6VHHH4YNsM1n7nHQpk",
                "public_test_key"  => "pk_test_zAsblhyos8R4Z3XuSz6lAfFz"
            ); 
    
            if ($params['testmode'] == "off") {
                \Stripe\Stripe::setApiKey($params['public_test_key']);
                $pubkey = $params['private_test_key'];
            } else {
                \Stripe\Stripe::setApiKey($params['public_live_key']);
                $pubkey = $params['private_live_key'];
            }

            try {
                $dataCard = explode('/',$Expiry_Data);
                \Stripe\Stripe::setApiKey($pubkey);
                    $token = \Stripe\Token::create(array(
                    "card" => array(
                    "number" => $Card_No,
                    "exp_month" => $dataCard[0],
                    "exp_year" => $dataCard[1],
                    "cvc" => $Cvv_Code
                   )
                 ));
            } catch(\Stripe\Error\Card $e) {
                $response['success'] = 0;
                $response['message'] = 'Your card was declined. Please, check your card details.';
                echo json_encode($response);
                die;
            }
        endif;


        $userBankDetails=$db->query("select * from user_bank_info where User_Id='$User_Id'");
        if($userBankDetails->rowCount() > 0)
        {
            if($BanInfo_Type == 'Bank'):
                $update = $db->query("UPDATE `user_bank_info` SET Bank_Name = '$Bank_Name' , Account_Number = '$Account_Number', Routing_Number = '$Routing_Number', Date_of_Birth = '$Date_of_Birth' WHERE User_Id = '$User_Id'");
                if($update)
                { 
                    $response['success'] = 1;               
                    $response['message'] = "Your bank detalis successfully Updated.";
                }
                else
                {
                    $response['success'] = 0;
                    $response['message'] = "Your bank detalis not Update. Please, try again.";
                }
            elseif($BanInfo_Type == 'Card'):
                $update = $db->query("UPDATE `user_bank_info` SET Account_HolderName = '$Account_HolderName' , Card_No = '$Card_No', Expiry_Data = '$Expiry_Data', Cvv_Code = '$Cvv_Code' WHERE User_Id = '$User_Id'");
                if($update)
                { 
                    $response['success'] = 1;               
                    $response['message'] = "Your card detalis successfully Updated.";
                }
                else
                {
                    $response['success'] = 0;
                    $response['message'] = "Your card detalis not Update. Please, try again.";
                }
            endif;
        }
        else
        {
            $insert = $db->query("INSERT INTO `user_bank_info` (User_Id,BanInfo_Type, Bank_Name, Account_Number, Routing_Number ,Date_of_Birth,Account_HolderName,Card_No, Expiry_Data,Cvv_Code) 
            VALUES ('$User_Id','$BanInfo_Type', '$Bank_Name', '$Account_Number', '$Routing_Number', '$Date_of_Birth','$Account_HolderName','$Card_No','$Expiry_Data','$Cvv_Code')");   
            if($insert)
            { 
                $response['success'] = 1;               
                $response['message'] = "Your payment detalis successfully Updated.";
            }
            else
            {
                $response['success'] = 0;
                $response['message'] = "Your payment detalis not Update. Please, try again.";
            }
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