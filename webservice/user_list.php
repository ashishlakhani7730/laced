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

        
        $user = $db->query("SELECT * FROM `auction_user` WHERE User_Id= '$User_Id' ");

        if ($user->Rowcount() > 0) {
            $i = 0;
            $d = '';
            $ph = array();
            

            while ($feuser = $user->fetch()) {

                $ph[$i]["User_Id"] = $feuser['User_Id'];
		$ph[$i]["User_FullName"] = $feuser['User_FullName'];
                $ph[$i]["User_Name"] = $feuser['User_Name'];
                $ph[$i]['User_ProfilePic'] = $feuser['User_ProfilePic'] != '' ? $DefaultUrl . $feuser['User_ProfilePic'] : '';
                $ph[$i]["User_Email"] = $feuser['User_Email'];
                $ph[$i]["User_Address"] = $feuser['User_Address'];
                $ph[$i]["User_Phone"] = $feuser['User_Phone'];
                $ph[$i]["User_UnitNo"] = $feuser['User_UnitNo'];
                $ph[$i]["User_City"] = $feuser['User_City'];
                $ph[$i]["User_State"] = $feuser['User_State'];

                $follow = $db->query("SELECT * FROM follow WHERE User_Id_One = '" . $feuser ['User_Id'] . "' OR User_Id_Two= '" . $feuser ['User_Id'] . "'");
                $TotalFollower = 0;
                
                while ($fefollow = $follow ->fetch()) {
                    $TotalFollower = $TotalFollower  + $fefollow ['Follow_Status'];
                    
                }
                $ph[$i]["Followers"] =  $TotalFollower ;  

                

                $trade = $db->query("SELECT * FROM trade WHERE User_Id= '$User_Id' AND  Trade_Status= '1'");
                $Totaltrade = 0;
                
                while ($fetrade = $trade ->fetch()) {
                    $Totaltrade = $Totaltrade + $fetrade ['Trade_Status'];
                    
                }
                $ph[$i]["Traded"] =  $Totaltrade ;                


                $auction = $db->query("SELECT * FROM auction_item WHERE User_Id= '" . $feuser ['User_Id'] . "' AND Item_Type= '3'");
                $Totalauction = 0;
                while ($feauction  = $auction ->fetch()) {
                    $Totalauction = $Totalauction + $feauction ['Item_Status'];
                    
                }
                $ph[$i]["Auctioned"] =  $Totalauction ;

                $sold = $db->query("SELECT * FROM user_purchase_item WHERE Seller_Id= '$User_Id' AND Purchase= '1'");
                $Totalsold = 0;
                
                while ($fesold = $sold ->fetch()) {
                    $Totalsold  = $Totalsold + $fesold ['Purchase'];
                    
                }
                $ph[$i]["Sold"] =  $Totalsold  ;
		
		if($feuser['User_verified'] == '1')
        	{
              $ph[$i]["Is_User_Verified"]  = 1;
        	}
        	else
        	{
        	$ph[$i]["Is_User_Verified"]  = 0;
        	}

                
                $ph[$i]["Active"] = ago($feuser['created']);
                        
                
                
                $i++;
            }
            if (sizeof($ph) > 0) {
                $response['success'] = 1;
                $response['UserList'] = $ph;
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
