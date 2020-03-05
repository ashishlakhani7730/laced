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
				$get = array();
                $update = $db->query("SELECT orderstatus FROM  `tracking` WHERE order_id='$order_id' order by orderstatus");
				//$feuser=$update->fetch(PDO::FETCH_NUM);
			
				$i=0;
				while($feuser=$update->fetch(PDO::FETCH_ASSOC))
				{
					 $get[] = $feuser["orderstatus"];
					 //$i++;
				}
				//print_r($get);exit;
				if(isset($get[0]) && $get[0] == 1)
				{
					$trackingDetails['ordered'] = 1;
				}
				else
				{
					$trackingDetails['ordered'] = 0;
				}
				if(isset($get[1]) && $get[1] == 2)
				{
					$trackingDetails['confirmed'] = 1;
				}
				else
				{
					$trackingDetails['confirmed'] = 0;
				}
				if(isset($get[2]) && $get[2] == 3)
				{
					$trackingDetails['packaging'] = 1;
				}
				else
				{
					$trackingDetails['packaging'] = 0;
				}
				if(isset($get[3]) && $get[3] == 4)
				{
					$trackingDetails['shippingLaced'] = 1;
				}
				else
				{
					$trackingDetails['shippingLaced'] = 0;
				}
				if(isset($get[4]) && $get[4] == 5)
				{
					$trackingDetails['deliverdLaced'] = 1;
				}
				else
				{
					$trackingDetails['deliverdLaced'] = 0;
				}
				if(isset($get[5]) && $get[5] == 6)
				{
					$trackingDetails['verifiedAuthentic'] = 1;
				}
				else
				{
					$trackingDetails['verifiedAuthentic'] = 0;
				}
				if(isset($get[6]) && $get[6] == 7)
				{
					$trackingDetails['shippingYou'] = 1;
				}
				else
				{
					$trackingDetails['shippingYou'] = 0;
				}
				if(isset($get[7]) && $get[7] == 8)
				{
					$trackingDetails['deliverd'] = 1;
				}
				else
				{
					$trackingDetails['deliverd'] = 0;
				}
				if(isset($get[8]) && $get[8] == 9)
				{
					$trackingDetails['complate'] = 1;
				}
				else
				{
					$trackingDetails['complate'] = 0;
				}
				//print_r($get);exit;
				$response['Tracking_Order'] = $trackingDetails;
				
				
				
	}
}
echo json_encode($response);
?>