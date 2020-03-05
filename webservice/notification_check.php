<?php 
include "db.php";
include "function.php";

//$ID = 'dK9cGb2GCJ8:APA91bFWIUfjG6N4E9qUjZxO6POXMqisQWMy-ej62c9PssNOv2ml15OtYYsiEpFJy0e7_JWZ1ABEsvBv_RN1_oh6OFefu9jx8oIClPtXt4Xz5_9bVIIhdJgC60J0JWrR5vKk5NuyQtcBYbPIUw5BX6WrnLMQxGPFYA';
$ID = 'dGHiQV4HajY:APA91bHHK3oE-eQ8ZdmoDKlYIL_N7wKsl2C18sKHGlUNJ3Gi2ix0nTS81-B0g-nlJTAB6Dozfb3_ZfemnT6W6ura5MoLBhaxCboabEX12QnNnDzFfPCdEvlTYUACz1JOn_pViJ0pkyNpaAFDboM6CZ94d_Xl_Ayafw'; 
//$notification1 = sendPushNotificationFromAndroidOrIos($ID,'android','Testing Notifications','Laced');
//$notification2 = sendPushNotificationFromAndroidOrIos($ID,'iOS','Testing Notifications','Laced');
 $title = 'Laced apps Sharing Reward';
                    $message = 'Vrushik Patel just use laced refer link and your account creadited $20';
                    $data['Type'] = 1;
                    $data['ID'] = 2;
                    
                    
                $notification2=    sendPushNotificationFromAndroidOrIos($ID,$title,$message,$data);
print_r($notification2);
die;

?>