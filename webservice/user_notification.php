<?php
include "db.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST")
{
    if(isset($_REQUEST['User_Id']))
    {
        $response = array();
  
        $User_Id = $_REQUEST['User_Id'];
        $admin= $db->query("SELECT * FROM `auction_admin`");
        $feadmin=$admin->fetch();
        $notification = $db->query("SELECT * FROM `notification` WHERE User_Id ='$User_Id' AND Admin_Id != '".$feadmin['Admin_Id']."' ORDER BY created DESC");
        if($notification->rowCount() > 0)
        { 
            $noti = array(); $p = 0;
            $da = array(); $d = 0;
            $today = date('d M,Y'); 
            $yesterday = date('d M,Y', strtotime("-1 day")); 
            while($fenotification = $notification->fetch())
            {
                $conDate = explode(' ', $fenotification['created']);

                if(sizeof($noti) > 0)
                {
                    if($OldDate != $conDate[0])
                    {
                        $da[$d]['Notification_Date'] = date('d M,Y',strtotime($OldDate)) != $today ? date('d M,Y',strtotime($OldDate)) != $yesterday ? date('d M,Y',strtotime($OldDate)) : 'YESTERDAY'  : 'TODAY';
                        $da[$d]['Notification_List'] = $noti;
                        $noti = array(); $p = 0;
                        $d++;
                    }

                }
                $OldDate = $conDate[0];
                $noti[$p]['Notification_Id'] = $fenotification['Notification_Id'];
                $noti[$p]['Notification_Title'] = $fenotification['Notification_Title'];
                $noti[$p]['Notification_Message'] = $fenotification['Notification_Message'];
                $noti[$p]['Notification_Type'] = $fenotification['Notification_Type'];
                $noti[$p]['Notification_Time'] = date('h:ia',strtotime($conDate[1]));
                $noti[$p]['Notification_Date'] = date('d M,Y',strtotime($OldDate)) != $today ? date('d M,Y',strtotime($OldDate)) != $yesterday ? date('d M,Y',strtotime($OldDate)) : 'YESTERDAY'  : 'TODAY';
                $p++;
            }
            
            if(sizeof($noti) > 0)
            { 
                $response['success'] = 1;  
                $response['Notification'] = $noti;                 
                $response['message'] = "User Notification List";
            }
            else
            {
                $response['success'] = 0;
                $response['message'] = "No History Found";
            }
        }
        else
        {
            $response['success'] = 0;    
            $response['message'] = "No History Found";
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