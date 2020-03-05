<?php

//al - 7/4/2018 - for check user is active or not. if active return true otherwise false.
function useractive($userid)
{
    global $db;

    $query = $db->query("SELECT * FROM `auction_user` WHERE `User_Id` = '$userid' AND `User_Status` = '1'");

   if($query->rowCount() > 0) 
   {
        return true;
   }
   else
   {
        return false;
   }
}

function fetchAllSubCategories($parent = 0,$i = 0, $CatArray = []) {
    global $db;
    
    $query = $db->query("SELECT * FROM `ubeatu_artist` WHERE `Artist_Id` = $parent  ORDER BY Artist_Id ASC");
    if ($query->rowCount() > 0) {
        $j = 0;
        while ($row = $query->fetch()) {
            $a =$row['User_Id'];
            array_push($CatArray,$a);
            $CatArray =fetchAllSubCategories($row['Artist_Id'],$j, $CatArray);
          
          $i++;
        }
    }
    return $CatArray;
}   
function uniqFileNameGenerator($fileName) {
    if (!empty($fileName)):
        $fileType = $fileName['type'];
        $fileTypeToArray = explode('/', $fileType);
        $fileExtention = $fileTypeToArray[1];
        if (!empty($fileExtention)):
            $newFileName = rand() . md5(@date('YmdHis')) . uniqid() . '.' . $fileExtention;
            if (!empty($newFileName)):
                return $newFileName;
            else:
                return FALSE;
            endif;
        else:
            return FALSE;
        endif;
    else:
        return FALSE;
    endif;
}


function sendPushNotificationFromAndroidOrIos1($registrationId=NULL, $title = NULL, $messageBody = NULL, $data = array(),$deviceType=NULL)
{

    $data['message'] =  $messageBody;
    $data['title'] =  $title;    
    $data['vibrate'] =  1;
    $data['sound'] =  1;
   
   
    $url = "https://fcm.googleapis.com/fcm/send";
    // $arrayToSend = array('to' => $registrationId, 'data' => $data,'priority'=>'high');
    $arrayToSend='';
    if($deviceType == 'iOS'){
        $arrayToSend = array('to' => $registrationId, 'notification' => array("title" => $title,"body" => $messageBody,"sound" => "default"),'priority'=>'high');

    }elseif ($deviceType == 'android') 
    {
        $arrayToSend = array('to' => $registrationId, 'data' => array("title" => $title,"body" => $messageBody,"sound" => "default"),'priority'=>'high');        
    }
    // $arrayToSend = array('to' => $registrationId, 'notification' => array("title" => $title,"body" => $data,"sound" => "default"),'priority'=>'high');
    $json = json_encode($arrayToSend);
    
    $headers = array();
    $headers[] = 'Authorization: key= AAAAaEhUflA:APA91bFDj9_1RHuC56RWPzn6jcpcaMEv2M6GYmPOQUoHl0D-ZXsPmIDUqU1UKUBl7FRpyy07A9T8MRjdUj9NwcA3Y45tlja6etmqBZj8Q3UsMQzZeM5z5Ly_FVgwifG8yta_epKKWVXs3WZAvfEX5r8cVAeTA2mdQQ';
    $headers[] = 'Content-Type: application/json';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //Send the request
    $response = curl_exec($ch);    
    curl_close($ch);
    return $response;
}


function sendPushNotificationFromAndroidOrIos2($registrationId=NULL, $title = NULL, $messageBody = NULL, $data = array())
{

    $data['message'] =  $messageBody;
    $data['title'] =  $title;    
    $data['vibrate'] =  1;
    $data['sound'] =  1;   

    $url = "https://fcm.googleapis.com/fcm/send";
    // $arrayToSend = array('to' => $registrationId, 'data' => $data,'priority'=>'high');
    $arrayToSend = array('registration_ids' => $registrationId, 'notification' => array("title" => $title,"body" => $messageBody,"sound" => "default"),'priority'=>'high');

    // $arrayToSend = array('to' => $registrationId, 'notification' => array("title" => $title,"body" => $data,"sound" => "default"),'priority'=>'high');
    $json = json_encode($arrayToSend);
    
    $headers = array();
    $headers[] = 'Authorization: key= AAAAaEhUflA:APA91bFDj9_1RHuC56RWPzn6jcpcaMEv2M6GYmPOQUoHl0D-ZXsPmIDUqU1UKUBl7FRpyy07A9T8MRjdUj9NwcA3Y45tlja6etmqBZj8Q3UsMQzZeM5z5Ly_FVgwifG8yta_epKKWVXs3WZAvfEX5r8cVAeTA2mdQQ';
    $headers[] = 'Content-Type: application/json';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //Send the request
    $response = curl_exec($ch);    
   
    curl_close($ch);
    return $response;
}



// function sendPushNotificationFromAndroidOrIos($registrationId, $title = NULL, $messageBody = NULL, $data = array())
// {
    
//     $data['message'] =  $messageBody;
//     $data['title'] =  $title;
//     $data['vibrate'] =  1;
//     $data['sound'] =  1;
   
//     $url = "https://fcm.googleapis.com/fcm/send";
//     $arrayToSend = array('to' => $registrationId, 'messageBody' => $data,'priority'=>'high');
//     $json = json_encode($arrayToSend);
    

//     $headers = array();
//     $headers[] = 'Content-Type: application/json';
//     $headers[] = 'Authorization: key= AAAAaEhUflA:APA91bFDj9_1RHuC56RWPzn6jcpcaMEv2M6GYmPOQUoHl0D-ZXsPmIDUqU1UKUBl7FRpyy07A9T8MRjdUj9NwcA3Y45tlja6etmqBZj8Q3UsMQzZeM5z5Ly_FVgwifG8yta_epKKWVXs3WZAvfEX5r8cVAeTA2mdQQ';
//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
//     curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     //Send the request
//     $response = curl_exec($ch);
    
//     echo "<pre>";
//     print_r($response);
//     die;
    
//     //Close request
//     // if ($response === FALSE) {
//     // die('FCM Send Error: ' . curl_error($ch));
//     // }
//     curl_close($ch);
//     return true;
// }

function sendPushNotificationFromAndroidOrIos($registrationId, $title = NULL, $messageBody = NULL, $data = array())
{
    
    $data['message'] =  $messageBody;
    $data['title'] =  $title;
    $data['vibrate'] =  1;
    $data['sound'] =  1;
    
     
    

    $url = "https://fcm.googleapis.com/fcm/send";
    $arrayToSend = array('to' => $registrationId, 'notification' => array("title" => "Simple FCM Client","body" => $data,"sound" => "default"),'priority'=>'high');
    $json = json_encode($arrayToSend);
    
    // echo "<pre>";
    // print_r($arrayToSend);
    // die;
    

    $headers = array();
    $headers[] = 'Authorization: key= AAAAaEhUflA:APA91bFDj9_1RHuC56RWPzn6jcpcaMEv2M6GYmPOQUoHl0D-ZXsPmIDUqU1UKUBl7FRpyy07A9T8MRjdUj9NwcA3Y45tlja6etmqBZj8Q3UsMQzZeM5z5Ly_FVgwifG8yta_epKKWVXs3WZAvfEX5r8cVAeTA2mdQQ';
    $headers[] = 'Content-Type: application/json';


    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //Send the request
    $response = curl_exec($ch);
    
    // echo "<pre>";
    print_r($response);
    die;
    
    //Close request
    // if ($response === FALSE) {
    // die('FCM Send Error: ' . curl_error($ch));
    // }
    curl_close($ch);
    return true;
}

function ago($mytime) {
    $time_ago1 = strtotime($mytime);
    $cur_time = time();
    $time_elapsed = $cur_time - $time_ago1;
    $seconds = $time_elapsed;
    $minutes = round($time_elapsed / 60);
    $hours = round($time_elapsed / 3600);
    $days = round($time_elapsed / 86400);
    $weeks = round($time_elapsed / 604800);
    $months = round($time_elapsed / 2600640);
    $years = round($time_elapsed / 31207680);
    // Seconds
    if ($seconds <= 60) {
        $post_time = "just now";
    }
    //Minutes
    else if ($minutes <= 60) {
        if ($minutes == 1) {
            $post_time = "1 minute ago";
        } else {
            $post_time = "$minutes minutes ago";
        }
    }
    //Hours
    else if ($hours <= 24) {
        if ($hours == 1) {
            $post_time = "1 hrs ago";
        } else {
            $post_time = "$hours hrs ago";
        }
    }
    //Days
    else if ($days <= 7) {
        if ($days == 1) {
            $post_time = "yesterday";
        } else {
            $post_time = "$days days ago";
        }
    }
    //Weeks
    else if ($weeks <= 4.3) {
        if ($weeks == 1) {
            $post_time = "1 week ago";
        } else {
            $post_time = "$weeks weeks ago";
        }
    }
    //Months
    else if ($months <= 12) {
        if ($months == 1) {
            $post_time = "1 month ago";
        } else {
            $post_time = "$months months ago";
        }
    }
    //Years
    else {
        if ($years == 1) {
            $post_time = "1 year ago";
        } else {
            $post_time = "$years years ago";
        }
    }
    return $post_time;
}

?>