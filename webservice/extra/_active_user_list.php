<?php

include "db.php";
include "function.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") {
    if (isset($_REQUEST['User_Id']) ) {

        $response = array();

        $User_Id = $_REQUEST['User_Id'];
        $created = date("Y-m-d H:i:s");
             
        $user = $db->query("SELECT * FROM `auction_user` WHERE Is_Login ='1' ");

        if ($user->Rowcount() > 0) {
            $i = 0;
            $d = '';
            $ph = array();
            

            while ($feuser = $user->fetch()) {

                $ph[$i]["User_Id"] = $feuser['User_Id'];

                $ph[$i]["User_Name"] = $feuser['User_Name'];
                $ph[$i]['User_ProfilePic'] = $feuser['User_ProfilePic'] != '' ? $DefaultUrl . $feuser['User_ProfilePic'] : '';
                $ph[$i]["User_Email"] = $feuser['User_Email'];
                $ph[$i]["User_Address"] = $feuser['User_Address'] != '' ? $feuser['User_Address']: '';
                $ph[$i]["User_Phone"] = $feuser['User_Phone'];
                
                $follow = $db->query("SELECT * FROM follow WHERE User_Id_One = '" . $feuser ['User_Id'] . "' OR User_Id_Two= '" . $feuser ['User_Id'] . "'");
                $TotalFollower = 0;
                
                while ($fefollow = $follow ->fetch()) {
                    $TotalFollower = $TotalFollower  + $fefollow ['Follow_Status'];
                    
                }
                $ph[$i]["Followers"] =  $TotalFollower ; 
               
                
                
                
                $i++;
            }
            if (sizeof($ph) > 0) {
                $response['success'] = 1;
                $response['ActiveUserList'] = $ph;
                $response['message'] = "User List found";
            } else {
                $response['success'] = 0;
                $response['message'] = "No List found";
            }
        } else {
            $response['success'] = 0;
            $response['message'] = "No List found";
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
