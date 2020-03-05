<?php
include "db.php";
include "function.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST")
{
    if( isset($_REQUEST['User_Id']) && isset($_REQUEST['Contest_Url'])  && isset($_REQUEST['Type']))
    {
        $response = array();
        $User_Id = $_REQUEST['User_Id'];
        $Contest_Url = $_REQUEST['Contest_Url'];
        $Type = $_REQUEST['Type'];
        $created=date("Y-m-d H:i:s");
        $user  = $db->query("SELECT * FROM auction_user WHERE User_Id = '$User_Id'");
        $feuserdata = $user->fetch();        
        $check = $db->query("SELECT * FROM auction_user WHERE User_Url = '$Contest_Url' AND !FIND_IN_SET('$User_Id',User_Install_User)");      
        if($check->rowCount() > 0)
        {
            $feuser = $check->fetch();
            if($Type == 'Install')
            {            	
                if(!empty($feuserdata['User_DeviceToken'])){
                    $userID = $feuserdata['User_DeviceToken'];
                    $title = 'Laced apps Sharing Reward';
                    $message = $feuser['User_FullName'].' just use laced refer link and your account credited $20';
                    $data['Type'] = 1;
                    $data['ID'] = $User_Id;
                    sendPushNotificationFromAndroidOrIos1($userID,$title,$message,$data,$feuserdata['User_DeviceType']);
                }
                $Install = $feuser['User_Install'] + 1;
                $installUser = $fecontest['User_Install_User'] != '' ? $fecontest['User_Install_User'].','.$User_Id : $User_Id;
                $db->query("UPDATE `auction_user` SET `User_Install`= '$Install',User_Install_User = '$installUser' WHERE User_Url = '$Contest_Url'");
                $response["success"] = 1;
                $response["message"] = "New apps Installation. Reward Successfully add to your Wallet";
            }
            else if($Type == 'Share')
            {
                $Share = $feuser['User_Share'] + 1;
                $db->query("UPDATE `auction_user` SET `User_Share`= '$Share' WHERE User_Url = '$Contest_Url'");
                $response["success"] = 1;
                $response["message"] = "Your Sharing Status update successfully.";
            }
            else
            {
                $response["success"] = 0;
                $response["message"] = "Type is wrong";
            }
        }
        else
        {
        	$user1  = $db->query("SELECT * FROM auction_user WHERE User_Id = '$fecontest[User_Id]'");
        	$feuserdata1 = $user1->fetch();        	
            $check1 = $db->query("SELECT * FROM contest_user WHERE Contest_Url = '$Contest_Url' AND !FIND_IN_SET('$User_Id',Contest_Install_User)");
            if($check1->rowCount() > 0)
            {
                $fecontest = $check1->fetch();
                         	
                if($Type == 'Install')
                {
                    if(!empty($feuser['User_DeviceToken'])){
                        $userID = $feuserdata1['User_DeviceToken'];
                        $title = 'Laced apps Contest Joined';
                        $message = $fecontest['User_FullName'].' just use laced contest link and you have been awarded 5 Entries';
                        $data['Type'] = 2;
                        $data['ID'] = $User_Id;
                        sendPushNotificationFromAndroidOrIos1($userID,$title,$message,$data,$feuserdata1['User_DeviceType']);
                    }
                    $Install = $fecontest['Contest_Install'] + 1;
                    $installUser = $fecontest['Contest_Install_User'] != '' ? $fecontest['Contest_Install_User'].','.$User_Id : $User_Id;
                    $db->query("UPDATE `contest_user` SET `Contest_Install`= '$Install',Contest_Install_User = '$installUser' WHERE Contest_Url = '$Contest_Url'");
                    $response["success"] = 1;
                    $response["message"] = "Your Friend Contest Reawrd successfully add.";
                }
                else if($Type == 'Share')
                {
                    $Share = $fecontest['Contest_Share'] + 1;
                    $db->query("UPDATE `contest_user` SET `Contest_Share`= '$Share' WHERE Contest_Url = '$Contest_Url'");
                    $response["success"] = 1;
                    $response["message"] = "Thank You for Sharing Laced Product.";
                }
                else
                {
                    $response["success"] = 0;
                    $response["message"] = "Type is wrong";
                }
            }
            else
            {
                $response["success"] = 0;
                $response["message"] = "Sorry, Link is expired. Please, try again.";
            }
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
