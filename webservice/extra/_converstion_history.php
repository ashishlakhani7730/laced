<?php
include "db.php"; 
include "function.php";
header('Content-Type: application/json');
if(isset($_REQUEST['User_Id']))
{
    $response = array();
    $User_Id = $_REQUEST['User_Id'];
    $converstion = $db->query("SELECT * FROM auction_conversation WHERE User_IdOne = '$User_Id' or User_IdTwo = '$User_Id' ORDER BY Converstion_Time DESC"); 
   
    if($converstion->rowCount() > 0)
    { 
        $ph = array(); $i = 0;   
        while($feconverstion = $converstion->fetch())
        {                        
            $Receiver_Id = $feconverstion['User_IdOne'] != $User_Id ? $feconverstion['User_IdOne'] : $feconverstion['User_IdTwo'];

            $user = $db->query("SELECT * from auction_user where User_Id = '$Receiver_Id'");
            $feuser = $user->fetch();

            $ph[$i]['Converstion_Id'] = $feconverstion['Converstion_Id'];
            $ph[$i]['Receiver_Id'] = $feuser['User_Id'];
            $ph[$i]['Receiver_Name'] = $feuser['User_FirstName'].' '.$feuser['User_LastName'];
            $ph[$i]['Receiver_ProfilePic'] = $feuser['User_ProfilePic'] != '' ? $DefaultUrl  . $file_name : $feuser['User_ProfileUrl'];
            $ph[$i]['Conversion_Time'] = ago($feconverstion['created']);

            $message = $db->query("SELECT * from auction_chat where Converstion_Id = '".$feconverstion['Converstion_Id']."' ORDER BY Chat_Id DESC");
            $femessage= $message->fetch();
            $ph[$i]['Last_Message'] = $femessage['Chat_Message'];

            $read = $db->query("SELECT * from auction_chat where Converstion_Id = '".$feconverstion['Converstion_Id']."' AND Sender_Id != '$User_Id' AND Read_Status = '0'");
            $ph[$i]['UnRead_Message'] = $read->rowCount();
            $i++;
        }
        if(sizeof($ph) > 0)
        {
            $response["success"] = 1;
            $response["ConversionHistory"] = $ph;
            $response["message"] = "Conversion List Display";
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
    $response["success"] = 1;
    $response["message"] = "Fields are missing";
}

echo json_encode($response);
?>