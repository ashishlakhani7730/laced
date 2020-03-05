<?php
include "db.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST")
{
    if(isset($_REQUEST['Bid_Id']) )
    {     
        $response = array();
        $Bid_Id = $_REQUEST['Bid_Id'];
        
        $Bid_Active = date("Y-m-d H:i:s");
        $check = $db->query("SELECT * FROM auction_bid WHERE Bid_Id = '$Bid_Id' "); 
            if($check->RowCount() > 0)
            {
                $db->query("UPDATE auction_bid SET Bid_Active='$Bid_Active' WHERE Bid_Id= '$Bid_Id'");
                $response['success'] = 1;
                $response['message'] = "Bid Activation Time Is Changed";
            }
            else
            {
                $response['success'] = 0;
                $response['message'] = "Activation Time Not Change";   
            }
   } 
   else
   {
        $response['success'] = 0;
        $response['message'] = "Fields are missing";       
   }
} 
else
{
    $response["success"] = 0;
    $response["message"] = "Inavlid Request Type(Use POST Method)";    
}
echo json_encode($response);
?>