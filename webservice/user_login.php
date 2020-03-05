<?php
include "db.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST")
{
    if( isset($_REQUEST['User_Email']) && isset($_REQUEST['User_Password'])  && isset($_REQUEST['User_DeviceType']) && isset($_REQUEST['User_DeviceToken']) )
    {
        $response = array();
        $User_Email = $_REQUEST['User_Email'];
        $User_Password = $_REQUEST['User_Password'];
        $User_DeviceType = $_REQUEST['User_DeviceType'];
        $User_DeviceToken = $_REQUEST['User_DeviceToken'];   
            
        $check = $db->query("SELECT * from auction_user WHERE User_Email = '$User_Email' AND User_Password = '$User_Password'");
        if($check->RowCount() > 0)
        {
            $fecheck= $check->fetch();
            $update = $db->query("UPDATE auction_user SET User_DeviceType = '$User_DeviceType', User_DeviceToken = '$User_DeviceToken', Is_Login= '1' where User_Id = '".$fecheck['User_Id']."'");
            $strip=$db->query("SELECT * FROM User_Stripe_Info WHERE User_Id = '".$fecheck['User_Id']."' ");
            
            if($update)
            {
                $response["success"] = 1;
                $response["User_Id"] = $fecheck['User_Id'];
                $response["User_FullName"] = $fecheck['User_FullName'];
                $response["User_Name"] = $fecheck['User_Name'];
                $response["User_Email"] = $fecheck['User_Email'];
                $response["User_Phone"] = $fecheck['User_Phone'];
                $response["User_ProfilePic"] = $fecheck['User_ProfilePic'] != '' ? $DefaultUrl . $fecheck['User_ProfilePic'] : $fecheck['User_ProfilePic'];
                $response["User_Address"] = $fecheck['User_Address']!= "" ? $fecheck['User_Address'] : "";
                $response["User_UnitNo"] = $fecheck['User_UnitNo']!= "" ? $fecheck['User_UnitNo'] : "";
                $response["User_City"] = $fecheck['User_City']!= "" ? $fecheck['User_City'] : "";
                $response["User_State"] = $fecheck['User_State']!= "" ? $fecheck['User_State'] : "";
                $response["User_Url"] = $fecheck['User_Url']!= "" ? $fecheck['User_Url'] : "";
                $response["Is_User_Verified"]=   $strip->rowCount() > 0 ? 1 : 0;
                 
                $response["message"] = "Login Successfully";
            }
            else
            {
                $response["success"] = 0;
                $response["message"] = "Login not successfully,Please try again.";
            }
                      
        }
        else
        {
            $response["success"] = 0;
            $response["message"] = "Username or Password are wrong,Please try again.";
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
