<?php
include "db.php"; 
include "function.php";
header('Content-Type: application/json');
    if(isset($_REQUEST['User_Id'])  && isset($_REQUEST['Item_Id']) && isset($_REQUEST['Item_Type']))
{
    $response = array();
    $User_Id= $_REQUEST['User_Id'];
    $Item_Id= $_REQUEST['Item_Id'];
    $Item_Type= $_REQUEST['Item_Type'];
    $created =date("Y-m-d H:i:s");
    
    $item = $db->query("SELECT * FROM auction_item where User_Id='$User_Id' ");
    $feitem = $item->fetch();
    

    $flakerfee = $db->query("SELECT * FROM flakercharge ");
    $feflakerfee = $flakerfee->fetch();
    
    $fee=($feflakerfee['flate_fee'] *$feitem['Item_NormalPrice'] / 100 ) ;
     
    $response["success"] = 1;
    $response["flakerfee"] = $fee;
    $product_price=$feitem['Item_NormalPrice'];
    $insert=$db->query("INSERT INTO `flakerfees` (User_Id,Item_Id,fees,cutfees,product_price ) VALUES 
                                                                ('$User_Id','$Item_Id','$fee',1,$product_price)");

    $insert1=$db->query("UPDATE auction_item SET Flaker_Fee= '$fee' WHERE Item_Id= '$Item_Id' ");
    $myinsert = $db->lastInsertId();
        if ($insert && $insert1 ) {
            $response['success'] = 1;
            $response['message'] = "fee set Successfully";
        } else {
            $response["success"] = 0;
            $response["message"] = "fee Not set Successfully";
        }
}
else
{
        $response["success"] = 0;
        $response["message"] = "Fields are missing";
}
echo json_encode($response);
?>