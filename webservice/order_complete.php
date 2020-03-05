<?php
include "db.php";
include "function.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST")
{
    if( isset($_REQUEST['Order_Id']) )
    {
        $response = array();
    
        $Order_Id = $_REQUEST['Order_Id'];
       
        $created=date("Y-m-d H:i:s");
        
            
            $check = $db->query("SELECT * FROM auction_user_order WHERE Order_Id='$Order_Id'  ");
            $fecheck=$check->fetch();
            
            if($fecheck['Order_Status'] == '2' && $fecheck['Tracking_No2'] != ''){
                
           
              $update= $db->query("UPDATE `auction_user_order` SET `Order_Complete`= '1' WHERE Order_Id='".$fecheck['Order_Id']."'  ");

              if($update)
              {
                $response["success"] = 1;
                $response["message"] = "Order Completed ";

                if(!empty($fecheck)){
                  $dataArray=[];
                  $dataArray[]=$fecheck['User_Id'];
                  $dataArray[]=$fecheck['Seller_Id'];                  
                  $usersData=implode(',', $dataArray);             
                  $getUsers = $db->query("SELECT * FROM auction_user WHERE  User_Id IN ($usersData)");
                  $salarBuyers = $getUsers->fetchAll();               
                  $deviceTokens=[];;
                  foreach ($salarBuyers as $key => $salarBuyer) {
                      $deviceTokens[]=$salarBuyer['User_DeviceToken'];                    
                  }                  
                  $title='Order Completion';
                  $messageBody = 'Your order completed successfully.';
                  sendPushNotificationFromAndroidOrIos2($deviceTokens,$title,$messageBody);
                }              
                
              }

              else {                
                $response["success"] = 0;
                $response["message"] = "Order Not Completed Successfully ";
              }
            }
            else
            {
                $response["success"] = 0;
                $response["message"] = "Laced Not Shipped Order Please Wait";
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
