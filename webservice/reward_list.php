<?php

include "db.php";
include "function.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];

if ($REQUEST == "POST") {

    if (isset($_REQUEST['User_Id'])) {

        $response = array();
        $User_Id = $_REQUEST['User_Id'];

        $current_date = date("Y-m-d H:i:s");



        $reward = $db->query("SELECT *  FROM `reward` WHERE  End_Date > NOW()  order by Reward_Id DESC");
        if ($reward->Rowcount() > 0) {
            $ph = array();
            $i = 0;
            $d = '';
            $current_date = date("Y-m-d H:i:s");

                $user = $db->query("select * from auction_user where User_Id='$User_Id'  ");
                $feuser = $user->fetch();
                
            while ($fereward = $reward->fetch()) {

                   
                    $rewardhistory=$db->query("SELECT *  FROM `reward_history` WHERE User_Id='".$feuser['User_Id']."' AND Reward_Id='".$fereward['Reward_Id']."' ");
                    $ferewardhistory=$rewardhistory->Rowcount();
                    
                    $ph[$i]["Reward_Name"] = $fereward['Reward_Name'];
                    $ph[$i]["Reward_Code"] = $fereward['Reward_Code'];
                    $ph[$i]["Price"] = $fereward['Price'].' OFF Your Purchase > '.($fereward['Minimum_Price']?$fereward['Minimum_Price']: '-');
                    $ph[$i]["Price_Type"] = $fereward['Price_Type'];
                    $ph[$i]["No_Of_Use"] = $ferewardhistory;
                    $ph[$i]["Condition"] = $fereward['Condition'];
                    $i++;
                
                
            }
            if (sizeof($ph) > 0) {

                $response['success'] = 1;

                $response['RewardList'] = $ph;

                $response['message'] = "Reward List found";
            } else {
                $response['success'] = 0;
                $response['message'] = "List Not found";
            }
        } else {
            $response['success'] = 0;
            $response['message'] = "No history found";
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
