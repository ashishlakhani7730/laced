<?php
include "db.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
require_once('../stripepaymentgateway/init.php');
if ($REQUEST == "POST")
{
    if(isset($_REQUEST['User_Id']))
    {
        $response = array();
        $User_Id = $_REQUEST['User_Id'];
        $user = $db->query("SELECT * FROM auction_user WHERE User_Id = '$User_Id'");
        if($user->rowCount() > 0):
            $feuser=$user->fetch();
            $response['success'] = 1;   
            $response['wallet_balance'] = $feuser['wallet_balance'];            
            $response['message'] = "Your Wallet total Credit Balance";
        else:
            $response['success'] = 0;
            $response['message'] = "Somthing went to wrong. Please, try again.";
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