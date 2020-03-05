<?php
include "db.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST")
{
    if(isset($_REQUEST['User_Id']) && isset($_REQUEST['Old_Password']) && isset($_REQUEST['New_Password']))
    {     
        $response = array();
        $UserId = $_REQUEST['User_Id'];
        $OldPassword = $_REQUEST['Old_Password'];
        $NewPassword = $_REQUEST['New_Password'];
     
        $check = $db->query("SELECT * FROM `auction_user` WHERE `User_Id` = '$UserId' AND `User_Password` = '$OldPassword'"); 
            if($check->RowCount() > 0)
            {
                $db->query("UPDATE `auction_user` SET `User_Password`='$NewPassword' WHERE `User_Id`= '$UserId'");
                $response['success'] = 1;
                $response['message'] = "Successfully Change the Password";
            }
            else
            {
                $response['success'] = 2;
                $response['message'] = "OldPassword Is Wrong. Please,try again.";   
            }
   } 
   else
   {
        $response['success'] = 0;
        $response['message'] = "Fields are missing";       
   }
} 
else
{
    $response["success"] = 0;
    $response["message"] = "Inavlid Request Type(Use POST Method)";    
}
echo json_encode($response);
?>