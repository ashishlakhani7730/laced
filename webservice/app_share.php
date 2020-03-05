<?php
include "db.php";
include "function.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST")
{
    if( isset($_REQUEST['User_Id']) && isset($_REQUEST['User_Url']) )
    {
        $response = array();
    
        $User_Id = $_REQUEST['User_Id'];
        $User_Url = $_REQUEST['User_Url'];
        $created=date("Y-m-d H:i:s");
        
        
            $check = $db->query("SELECT * from `auction_user` WHERE User_Id = '$User_Id' AND User_Url = '$User_Url'");
            $fecheck=$check->fetch();
                $User_Install=$fecheck['User_Install'];
                if($User_Url == $fecheck['User_Url'] && $User_Id == $fecheck['User_Id'])
                {
                    $User_Install++;
                    
                }
                    $db->query("UPDATE `auction_user` SET `User_Install`= '$User_Install' WHERE User_Id = '$User_Id' AND User_Url = '$User_Url'");
                    
                    $response["success"] = 1;
                    $response["message"] = "update successfully";
            
    
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
