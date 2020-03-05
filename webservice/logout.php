<?php
include "db.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST")
{
    if( isset($_REQUEST['User_Id'])  )
    {
        $response = array();
        $User_Id = $_REQUEST['User_Id'];
          session_start();
            session_destroy();
        $check = $db->query("SELECT * from auction_user WHERE User_Id = '$User_Id'");
        if($check->RowCount() > 0)
        {
            
            $fecheck= $check->fetch();
            $update = $db->query("UPDATE auction_user SET Is_Login = '0' where User_Id = '".$fecheck['User_Id']."'");
            if($update)
            {
                $response["success"] = 1;
                
                $response["message"] = "Logout Successfully";
            }
            else
            {
                $response["success"] = 0;
                $response["message"] = "Logout not successfully,Please try again.";
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
