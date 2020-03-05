<?php

include "db.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") {
    if (isset($_REQUEST['User_Email']) && isset($_REQUEST['User_DeviceType']) && isset($_REQUEST['User_DeviceToken']) && isset($_REQUEST['Identifier_Id']) && isset($_REQUEST['Login_Type']) && isset($_REQUEST['User_FullName'])&& isset($_REQUEST['User_Name'])) {
        $response = array();
        $User_Email = $_REQUEST['User_Email'];
        $Identifier_Id = $_REQUEST['Identifier_Id'];
        $User_DeviceType = $_REQUEST['User_DeviceType'];
        $User_DeviceToken = $_REQUEST['User_DeviceToken'];
        $created = date("Y-m-d H:i:s");
        if($_REQUEST['Login_Type'] == 'facebook')
        {
            $TableId = 'FB_Id';
            $TableValue = 'facebook';
        }
        else{
            $TableId = 'Gmail_Id';
            $TableValue = 'gmail';
        }

        if (!empty($User_Email)) {
            $check = $db->query("SELECT * from auction_user WHERE User_Email = '$User_Email'");
            if ($check->rowCount() > 0) {
                $fecheck = $check->fetch();
                $update = $db->query("UPDATE auction_user SET  $TableId = '$Identifier_Id',Login_Type = '$TableValue', User_DeviceType = '$User_DeviceType', User_DeviceToken = '$User_DeviceToken' ,Is_Login = '1' where User_Id = '" . $fecheck['User_Id'] . "'");
                if ($update) {
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
                    $response["message"] = "Login Successfully";
                } else {
                    $response["success"] = 0;
                    $response["message"] = "Login not successfully,Please try again.";
                }
                echo json_encode($response);
                die();
            }
        }
        $check = $db->query("SELECT * from auction_user WHERE $TableId = '$Identifier_Id'");
        if ($check->rowCount() > 0) {
            
            $fecheck = $check->fetch();
            $update = $db->query("UPDATE auction_user SET  Login_Type = '$TableValue',User_Email = '$User_Email', User_DeviceType = '$User_DeviceType', User_DeviceToken = '$User_DeviceToken' ,Is_Login = '1' where User_Id = '" . $fecheck['User_Id'] . "'");
            if ($update) {
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
                $response["message"] = "Login Successfully";
            } else {
                $response["success"] = 0;
                $response["message"] = "Login not successfully,Please try again.";
            }
            echo json_encode($response);
            die();
        }

        
        $insert = $db->query("INSERT INTO `auction_user` ($TableId, User_FullName,User_Name,User_Email, User_DeviceType, User_DeviceToken, Login_Type, created) VALUES ('$Identifier_Id', '".$_REQUEST['User_FullName']."', '".$_REQUEST['User_Name']."','$User_Email', '$User_DeviceType', '$User_DeviceToken', '$TableValue',  '$created')");
        $UserID = $db->lastInsertId();
		
        $Notification_Title='User Register';
        $Notification_Message=$User_Name .' '. 'Register in Laced';
        $Notification_Type='User Register';

        $db->query("INSERT INTO `notification` (Admin_Id,User_Id, Notification_Title, Notification_Message,Notification_Type, created) VALUES ('1','$UserID', '$Notification_Title','$Notification_Message','$Notification_Type','$created')");
        if($insert)
        {
            $check = $db->query("SELECT * from auction_user WHERE User_Id = '$UserID'");
            $fecheck = $check->fetch();
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
            $response["message"] = "Login Successfully";
        }
        else
        {
            $response["success"] = 0;
            $response["message"] = "Login not successfully,Please try again.";
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