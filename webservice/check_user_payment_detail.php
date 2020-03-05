<?php
include "db.php";
include "function.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") {

	if (isset($_REQUEST['User_Id'])) {

		$User_Id = $_REQUEST['User_Id'];

        $bankInfo = $db->query("SELECT * FROM User_Stripe_Info WHERE User_Id= '$User_Id'");
       
        if($bankInfo->rowCount() > 0)
        {
            $response['success'] = 1;
            $response['message'] = "Payment Information is Available";
        }
        else
        {
        	$response['success'] = 0;
            $response['message'] = "Please, Set first payment Information.";
       	}
	}
    else {
        $response["success"] = 0;
        $response["message"] = "Fields are missing";
    }
} else {
    $response["success"] = 0;
    $response["message"] = "Invalid Request Type(Use POST Method)";
}
echo json_encode($response);