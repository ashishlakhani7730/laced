<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include "db.php";
include "function.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];

if ($REQUEST == "POST")
{
    if(isset($_REQUEST['order_id']) && isset($_REQUEST['user_id']))
    {   
		$response = array();
		$order_id = $_REQUEST['order_id'];
		$user_id = $_REQUEST['user_id'];
		$orderstatus = $_REQUEST['orderstatus'];
		
			//$orderstatus = 1;
			
			$insert = $db->query("INSERT INTO `tracking` (order_id, user_id, orderstatus) VALUES ('$order_id', '$user_id', '$orderstatus')");
			
		
		if($insert)
        {
			$response['success'] = 1;               
            $response['message'] = "Thank You for Your shipping detail add";
		}		
	}
}
echo json_encode($response);
?>