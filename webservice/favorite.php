<?php
include "db.php";
include "function.php";
header('Content-Type: application/json');
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") {
    if (isset($_REQUEST['User_Id']) && isset($_REQUEST['Item_Id']) && isset($_REQUEST['Type'])) {
        $response = array();
        $User_Id = $_REQUEST['User_Id'];
        $Item_Id = $_REQUEST['Item_Id'];
        $Type = $_REQUEST['Type'];
        $created = date("Y-m-d H:i:s");

        if($Type == 'Favorite')
        {
            $check = $db->query("SELECT * FROM favorite WHERE Item_Id = '$Item_Id' and User_Id = '$User_Id'  ");
            if($check->rowCount() == 0){
                $db->query("INSERT INTO `favorite`(`User_Id`, `Item_Id`,`Favorite_Status`, `created`) VALUES ('$User_Id','$Item_Id','1','$created')");
                
                $item = $db->query("SELECT * FROM `auction_item` WHERE `Item_Id` = '$Item_Id'");
                $feitem = $item->fetch();
                
                $response["success"] = 1;
                $response["message"] = "Item added to your favorite list";
            }
            else   
            {
                $response["success"] = 0;
                $response["message"] = "item already added to your favorite list";
            }
            
        }
         else if($Type == 'Unfavorite')
        {   
            $check = $db->query("SELECT * FROM favorite WHERE Item_Id = '$Item_Id' and User_Id = '$User_Id'  ");
            if($check->rowCount() > 0){
                $db->query("DELETE FROM favorite WHERE  Item_Id = '$Item_Id' and User_Id = '$User_Id'");
                $response["success"] = 1;
                $response["message"] = "Item remove to your favorite list";
            }
            else
            {
                $response["success"] = 0;
                $response["message"] = "Item already Remove to your favorite list";
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