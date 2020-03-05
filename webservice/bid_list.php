<?php

include "db.php";
include "function.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") {
    if (isset($_REQUEST['User_Id']) && isset($_REQUEST['Item_Id']) ) {

        $response = array();

        $User_Id = $_REQUEST['User_Id'];
        $Item_Id= $_REQUEST['Item_Id'];

       $created=date("Y-m-d H:i:s");

       


        $bid = $db->query("SELECT * FROM `auction_bid` WHERE Item_Id='$Item_Id' order by Bid_id DESC ");

        if ($bid->Rowcount() > 0) {
            $i = 0;
            $d = '';
            $ph = array();
            $current_date = date("Y-m-d H:i:s");
           
            while ($febid = $bid->fetch()) {

                $item = $db->query("SELECT * FROM auction_item ");
                $feitem = $item->fetch();


                $ph[$i]["Bid_id"] = $febid['Bid_id'];
                $ph[$i]["User_Id"] = $febid['User_Id'];

                $user = $db->query("SELECT * FROM auction_user WHERE User_Id = '" . $febid['User_Id'] . "'");
                $feuser = $user->fetch();
                $ph[$i]["User_Name"] = $feuser['User_Name'];
                $ph[$i]['User_ProfilePic'] = $feuser['User_ProfilePic'] != '' ? $DefaultUrl . $feuser['User_ProfilePic'] : '';
                $ph[$i]["Item_Name"] = $feitem['Item_Name'];
                $ph[$i]["Bid_Price"] = $febid['Bid_Price'];

                $ph[$i]["Active"] = ago($febid['created']);

                
                $i++;
            }
            if (sizeof($ph) > 0) {
                $response['success'] = 1;
                
                $response['BidList'] = $ph;
                $response['message'] = "Bid List found";
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
