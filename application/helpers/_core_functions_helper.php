<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
function sendMail($messageBody, $Admin_Email) {
    require("./PHPMailer/PHPMailerAutoload.php");
    $messagebody = $messageBody;
    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';   
    $mail->SMTPAuth = false;
     $mail->Username = 'savan.sensussoft@gmail.com';   
     $mail->Password = 'savan@sensussoft';  
     $mail->Password = 'bafadngwykwbrshs';  
     $mail->SMTPSecure = 'tls';  
     $mail->Port = 587;  

    $mail->From = $DefaultEmailID;
    $mail->FromName = $DefaultEmailSenderName;

    $mail->addAddress($Admin_Email);
    $mail->isHTML(true);

    $mail->Subject = 'Olive Tree Password Recovery';
    $mail->Body = $messagebody;
    $mail->smtpConnect(
            array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            )
    );
    $mail->send();

    if (!empty($Admin_Email)):
        return TRUE;
    endif;
}

function sendPushNotificationFromAndroidOrIos($registrationId=NULL, $title = NULL, $messageBody = NULL, $data = array(),$deviceType=NULL)
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
