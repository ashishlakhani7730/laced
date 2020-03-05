<?php
include "db.php";
include "function.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST")
{
    if( isset($_REQUEST['User_Id']) && isset($_REQUEST['Contest_Url'])  && isset($_REQUEST['Type']))
    {
        $response = array();
    
        $User_Id = $_REQUEST['User_Id'];
        $Contest_Url = $_REQUEST['Contest_Url'];
        $Type = $_REQUEST['Type'];
        $created=date("Y-m-d H:i:s");
        if($Type == 'Install')
        {
            
            $check = $db->query("SELECT * from `contest_user` WHERE User_Id = '$User_Id' AND Contest_Url = '$Contest_Url'");
            $fecheck=$check->fetch();
                $Contest_Install=$fecheck['Contest_Install'];
                if($Contest_Url == $fecheck['Contest_Url'] && $User_Id == $fecheck['User_Id'])
                {
                    $Contest_Install++;
                    
                }
                    $db->query("UPDATE `contest_user` SET `Contest_Install`= '$Contest_Install' WHERE User_Id = '$User_Id' AND Contest_Url = '$Contest_Url'");
                    
                    $response["success"] = 1;
                    $response["message"] = "update successfully";
               
        
            $checks = $db->query("SELECT * from `auction_user` WHERE User_Id = '$User_Id' AND User_Url = '$Contest_Url'");
            $fechecks=$checks->fetch();
                $User_Install=$fechecks['User_Install'];
                if($Contest_Url == $fechecks['User_Url'] && $User_Id == $fechecks['User_Id'])
                {
                    $User_Install++;
                    
                }
                    $db->query("UPDATE `auction_user` SET `User_Install`= '$User_Install' WHERE User_Id = '$User_Id' AND User_Url = '$Contest_Url'");
                    
                    $response["success"] = 1;
                    $response["message"] = "update successfully";
               
        }
        else if($Type == 'Share')
        {
            $check = $db->query("SELECT * from `contest_user` WHERE User_Id = '$User_Id' AND Contest_Url = '$Contest_Url'");
            $fecheck=$check->fetch();
                $Contest_Share=$fecheck['Contest_Share'];
                if($Contest_Url == $fecheck['Contest_Url'] && $User_Id == $fecheck['User_Id'])
                {
                    $Contest_Share++;
                    
                }
                    $db->query("UPDATE `contest_user` SET `Contest_Share`= '$Contest_Share' WHERE User_Id = '$User_Id' AND Contest_Url = '$Contest_Url'");
                    
                    $response["success"] = 1;
                    $response["message"] = "update successfully";
               
        
            $checks = $db->query("SELECT * from `auction_user` WHERE User_Id = '$User_Id' AND User_Url = '$Contest_Url'");
            $fechecks=$checks->fetch();
                $User_Share=$fechecks['User_Share'];
                if($Contest_Url == $fechecks['User_Url'] && $User_Id == $fechecks['User_Id'])
                {
                    $User_Share++;
                    
                }
                    $db->query("UPDATE `auction_user` SET `User_Share`= '$User_Share' WHERE User_Id = '$User_Id' AND User_Url = '$Contest_Url'");
                    
                    $response["success"] = 1;
                    $response["message"] = "update successfully";
            
        }
        else
        {
            $response["success"] = 0;
            $response["message"] = "Type is wrong";
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
