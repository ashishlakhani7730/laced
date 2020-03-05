<?php
include "db.php";
header('Content-Type: application/json');
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") {

    if (isset($_REQUEST['User_Id']) && isset($_REQUEST['Feedback'])  ) {
        $response = array();
        
        $User_Id = $_REQUEST['User_Id'];
        $Feedback = $_REQUEST['Feedback'];
        $created = date("Y-m-d H:i:s");

        $insert = $db->query("INSERT INTO `feedback` (User_Id, Feedback, created) VALUES ('$User_Id', '$Feedback','$created')");
        $myinsert = $db->lastInsertId();
        if ($insert) {
            $response['success'] = 1;
            $response['message'] = "Thank you for your feedback";
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
