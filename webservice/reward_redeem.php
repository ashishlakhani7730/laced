<?php

include "db.php";
include "function.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];

function rewardSet($User_Id, $Reward_Id) {
    global $db;
    $rewardcheck = $db->query("SELECT * FROM reward WHERE Reward_Id = '$Reward_Id' ");
    $ferewardcheck = $rewardcheck->fetch();
    if ($ferewardcheck['Condition'] == 'NoOfUser'):
        $Use = $ferewardcheck['No_Of_Use'] - 1;
        $db->query("UPDATE reward SET No_Of_Use = '$Use' WHERE Reward_Id = '$Reward_Id' ");
    endif;

    $seuser = $db->query("SELECT * FROM auction_user WHERE User_Id = '$User_Id' ");
    $feuser = $seuser->fetch();
    if (!empty($feuser['User_Reward'])):
        $reward = $db->query("SELECT * FROM reward WHERE Reward_Id = '" . $feuser['User_Reward'] . "' ");
        $fereward = $reward->fetch();
        if ($fereward['Condition'] == 'NoOfUser'):
            $Use = $fereward['No_Of_Use'] + 1;
            $db->query("UPDATE reward SET No_Of_Use = '$Use' WHERE Reward_Id = '" . $fereward['Reward_Id'] . "' ");
            $db->query("UPDATE auction_user SET User_Reward = '$Reward_Id' WHERE User_Id = '$User_Id' ");
            $db->query("INSERT INTO reward_history (User_Id,Reward_Id) VALUE('$User_Id','$Reward_Id')");
            return TRUE;
        elseif($fereward['Condition'] == 'FristPurchase'):
            $db->query("UPDATE auction_user SET User_Reward = '$Reward_Id' WHERE User_Id = '$User_Id' ");
            $db->query("INSERT INTO reward_history (User_Id,Reward_Id) VALUE('$User_Id','$Reward_Id')");
        else:
            $db->query("UPDATE auction_user SET User_Reward = '$Reward_Id' WHERE User_Id = '$User_Id' ");
            // $noofuse= $db->query("SELECT * FROM reward_history WHERE User_Id = '".$feuser['User_Id']."' AND Reward_Id='".$feuser['User_Reward']."'");
            // $fenoofuse=$noofuse->fetch();
            // $No_Of_Use=$fenoofuse['No_Of_Use']+1;
            $db->query("INSERT INTO reward_history (User_Id,Reward_Id) VALUE('$User_Id','$Reward_Id')");
            return TRUE;
        endif;
    else:
        $db->query("UPDATE auction_user SET User_Reward = '$Reward_Id' WHERE User_Id = '$User_Id' ");
        $db->query("INSERT INTO reward_history (User_Id,Reward_Id) VALUE('$User_Id','$Reward_Id')");
        return TRUE;
    endif;
}

if ($REQUEST == "POST") {

    if (isset($_REQUEST['User_Id']) && isset($_REQUEST['Reward_Code'])) {

        $response = array();
        $User_Id = $_REQUEST['User_Id'];
        $Reward_Code = $_REQUEST['Reward_Code'];

        $date = date("Y-m-d H:i:s");

        $reward = $db->query("select * from reward where Reward_Code='$Reward_Code'");

        if ($reward->rowCount() > 0) {
            $fereward = $reward->fetch();
            $Reward_Id = $fereward['Reward_Id'];

            $user = $db->query("select * from auction_user where User_Id='$User_Id'");
            $feuser = $user->fetch();

            if ($fereward['Start_Date'] <= $date && $date <= $fereward['End_Date']):
                if ($fereward['Condition'] == 'NoOfUser'):
                    if ($fereward['No_Of_Use'] > 0):
                        $reward = rewardSet($User_Id, $Reward_Id);
                        $response["success"] = 1;
                        $response["message"] = "Reword successfully added your accounts.";
                    else:
                        $response["success"] = 0;
                        $response["message"] = "Reword code User limit is over, Please, try again.";
                    endif;
                elseif ($fereward['Condition'] == 'FristPurchase'):
                    
                    $order = $db->query("select * from auction_user_order where User_Id='$User_Id'");
                    if ($order->rowCount() == 0):
                        $reward = rewardSet($User_Id, $Reward_Id);
                        $response["success"] = 1;
                        $response["message"] = "Reword successfully added your accounts.";
                    else:
                        $response["success"] = 0;
                        $response["message"] = "Reword code Use For Frist Purchse, Please, try again.";
                    endif;



                else:
                    $reward = rewardSet($User_Id, $Reward_Id);
                    $response["success"] = 1;
                    $response["message"] = "Reword successfully added your accounts..";
                endif;
            else:
                $response["success"] = 0;
                $response["message"] = "Reword code is expierd, Please, try again.";
            endif;
        }
        else {
            $response["success"] = 0;
            $response["message"] = "Invalid Reword code, Please, try again.";
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
