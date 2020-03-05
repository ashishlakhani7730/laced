<?php
include "db.php"; 
include "function.php";
header('Content-Type: application/json');
if(isset($_REQUEST['User_Id']) && isset($_REQUEST['Receiver_Id']))
{
    $response = array();
    $User_Id= $_REQUEST['User_Id'];
    $Receiver_Id= $_REQUEST['Receiver_Id'];
    
    $select = $db->query("SELECT * FROM auction_conversation WHERE (User_IdOne = '$User_Id' AND User_IdTwo = '$Receiver_Id') OR (User_IdOne = '$Receiver_Id' AND User_IdTwo = '$User_Id')");
    $feselect = $select->fetch();
    $Converstion_Id = $feselect['Converstion_Id'];

    $read_status = $db->query("SELECT * FROM auction_chat WHERE Converstion_Id = '$Converstion_Id' AND Sender_Id != '$User_Id'");
    while($feread_status = $read_status->fetch())
    {
        $updateread = $db->query("UPDATE auction_chat SET Read_Status = '1' WHERE Chat_Id = '".$feread_status['Chat_Id']."'");
    }
   
    $chat = $db->query("SELECT * FROM auction_chat WHERE Converstion_Id = '$Converstion_Id'");
    if ($chat->rowCount() > 0)
    {  
        $i = 0;
        $ph=array();
        while($fechat = $chat->fetch())
        {
            $ph[$i]["Chat_Id"] = $fechat['Chat_Id'];    
            $ph[$i]["Chat_Message"] = $fechat['Chat_Message'];
            $user = $db->query("SELECT * FROM auction_user WHERE User_Id = '".$fechat['Sender_Id']."'");
            $feuser = $user->fetch();

            $ph[$i]["Sender_Id"] = $fechat['Sender_Id'];
            $ph[$i]['Sender_Name'] = $feuser['User_Name'];
            $ph[$i]['Sender_ProfilePic'] = $feuser['User_ProfilePic'] != '' ? $DefaultUrl  . $file_name : $feuser['User_ProfileUrl'];

            $ph[$i]["Read_Status"] = $fechat['Read_Status'];
            $ph[$i]["Chat_Time"] = ago($fechat['created']);
        
            $i++;
        }
        if(sizeof($ph) > 0)
        {
            $response["success"] = 1;
            $response["ChatHistory"] = $ph;
            $response["message"] = "Chat List Display";
        }
        else
        {
            $response["success"] = 0;
            $response["message"] = "No History Found";
        }
    
    }
    else
    {
        $response["success"] = 0;
        $response["message"] = "No History Found";
    }
}
else
{
    $response["success"] = 0;
    $response["message"] = "Fields are missing";
}
echo json_encode($response);
?>