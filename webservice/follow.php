<?php

header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") {
    if (isset($_REQUEST['User_Id']) && isset($_REQUEST['Receiver_Id']) && isset($_REQUEST['Type'])) {
        $response = array();
        include "db.php";

        $User_Id = $_REQUEST['User_Id'];
        $Receiver_Id = $_REQUEST['Receiver_Id'];
        $Type = $_REQUEST['Type'];
        $created = date("Y-m-d H:i:s");



        if($Type == 'Follow')
        {
            $check = $db->query("SELECT * FROM follow WHERE (User_Id_One = '$User_Id' AND User_Id_Two = '$Receiver_Id') OR (User_Id_One = '$Receiver_Id' AND User_Id_Two = '$User_Id') ");
            if($check->rowCount() == 0){
                $db->query("INSERT INTO `follow`(`User_Id_One`, `User_Id_Two`, `Follow_Status`,`created`) VALUES (
                    '$User_Id','$Receiver_Id','1','$created')");
                
                $response["success"] = 1;
                $response["message"] = "User Follow successfully";
            }
             else   
             {
                $response["success"] = 0;
                $response["message"] = "User already added to your follow list";
             }
            
        }
        else if($Type == 'Unfollow')
        {   
            $check = $db->query("SELECT * FROM follow WHERE (User_Id_One = '$User_Id' AND User_Id_Two = '$Receiver_Id') OR (User_Id_One = '$Receiver_Id' AND User_Id_Two = '$User_Id') ");
            if($check->rowCount() > 0){
                $db->query("DELETE FROM follow WHERE (User_Id_One = '$User_Id' AND User_Id_Two = '$Receiver_Id') OR (User_Id_One = '$Receiver_Id' AND User_Id_Two = '$User_Id')  ");
                $response["success"] = 1;
                $response["message"] = "User Unfollow successfully";
            }
            else
            {
                $response["success"] = 0;
                $response["message"] = "User already Remove to your follow list";
            }
        }
        
        else
        {
            $response["success"] = 0;
            $response["message"] = "Type is wrong";
        }
        
    } else {
        $response["success"] = 0;
        $response["message"] = "Fields are missing";
    }
} else {
    $response["success"] = 0;
    $response["message"] = "Invalid Request Type(Use POST Method)";
}
echo json_encode($response);
?>