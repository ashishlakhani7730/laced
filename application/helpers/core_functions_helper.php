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

function uniqFileNameGeneratorForBonanza($fileName) {
    if (!empty($fileName)):
        $getFileName = explode('.', $fileName);
        $fileExtention = $getFileName[1];
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

function bonanzaImageUploadPath($imageName = NULL) {
    return FCPATH . 'Items/' . $imageName;
}

function bonanzaImageUploadURL($imageName = NULL) {
    return base_url() . 'Items/' . $imageName;
}

function makeImageTransparent($imageURL) {
    if (!empty($imageURL)):
        $post = [
            'url' => $imageURL,
            'key' => '5UgWTtBmAFalp3i',
            'user_id' => 'ocT1RxA0qVIlh9v'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://api.bonanza.com/api/background_burns');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        $response = curl_exec($ch);
        if (curl_error($ch)) {
            trigger_error('Curl Error:' . curl_error($ch));
        }
        curl_close($ch);
        $finalOutPut = json_decode($response);
        if(isset($finalOutPut->message))
        {
           print_r($finalOutPut->message);
           die; 
        }
        
        $convertedImageUrl = explode('?', @$finalOutPut->final_result_url)[0];
        if (!empty($convertedImageUrl)):
            $imageName = basename($convertedImageUrl);
            $uniqFileName = uniqFileNameGeneratorForBonanza($imageName);
            $imageDestinationPath = bonanzaImageUploadPath($uniqFileName);
            file_put_contents($imageDestinationPath, file_get_contents($convertedImageUrl));
            return $uniqFileName;
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

function sendPushNotificationFromAndroidOrIos($registrationId = NULL, $title = NULL, $messageBody = NULL, $data = array(), $deviceType = NULL) {

    $data['message'] = $messageBody;
    $data['title'] = $title;
    $data['vibrate'] = 1;
    $data['sound'] = 1;


    $url = "https://fcm.googleapis.com/fcm/send";
    // $arrayToSend = array('to' => $registrationId, 'data' => $data,'priority'=>'high');
    $arrayToSend = '';
    if ($deviceType == 'iOS') {
        $arrayToSend = array('to' => $registrationId, 'notification' => array("title" => $title, "body" => $messageBody, "sound" => "default"), 'priority' => 'high');
    } elseif ($deviceType == 'android') {
        $arrayToSend = array('to' => $registrationId, 'data' => array("title" => $title, "body" => $messageBody, "sound" => "default"), 'priority' => 'high');
    }
    // $arrayToSend = array('to' => $registrationId, 'notification' => array("title" => $title,"body" => $data,"sound" => "default"),'priority'=>'high');
    $json = json_encode($arrayToSend);

    $headers = array();
    $headers[] = 'Authorization: key= AAAAaEhUflA:APA91bFDj9_1RHuC56RWPzn6jcpcaMEv2M6GYmPOQUoHl0D-ZXsPmIDUqU1UKUBl7FRpyy07A9T8MRjdUj9NwcA3Y45tlja6etmqBZj8Q3UsMQzZeM5z5Ly_FVgwifG8yta_epKKWVXs3WZAvfEX5r8cVAeTA2mdQQ';
    $headers[] = 'Content-Type: application/json';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //Send the request
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}
function paymentRefund($userId,$payment){
   
    $ci =& get_instance();
    $paymentInfo = $ci->db->query("SELECT * FROM User_Stripe_Info WHERE User_Id = '$userId'");
//    $paymentInfo = $paymentInfo->row_array();
    
    if($paymentInfo->num_rows() > 0)
    {
        $message = 'Laced userID:'.$userId.' to Credit to Wallet balance';
      
        require_once('./stripepaymentgateway/init.php');
        $params = array(
            "testmode"  => "on",
            "private_live_key" => "sk_live_dndDG08hdcyh0JcL5b71kPFS",
            "public_live_key"  => "pk_live_xQmpClHOX13I7G7xgCuZ1PKB",
            "private_test_key" => "sk_test_fusISb6VHHH4YNsM1n7nHQpk",
            "public_test_key"  => "pk_test_zAsblhyos8R4Z3XuSz6lAfFz"
        ); 
        
        if ($params['testmode'] == "on") {
            \Stripe\Stripe::setApiKey($params['private_test_key']);
            $pubkey = $params['private_test_key'];
        } else {
            \Stripe\Stripe::setApiKey($params['private_live_key']);
            $pubkey = $params['public_test_key'];
        } 

        $fePaymentInfo = $paymentInfo->result();
       
        \Stripe\Stripe::setApiKey($pubkey);
       // $tokenId = $token['id'];
        try {
            $Ammount = explode('.',$payment);
            
            $Ammount = ($Ammount[0] * 100) + (isset($Ammount[1]) ? $Ammount[1] : 0 );
            $Stripe_User_Id=$fePaymentInfo[0]->Stripe_User_Id;
                   
            $charge = \Stripe\Payout::create(array(		 
                "amount" => $Ammount,
                "currency" => "usd",
                "description" => $message,
                "method" => "instant"), 
                array("stripe_account" =>$Stripe_User_Id)			  
            );     
            $transactionNo = $charge['balance_transaction'];
        } 
        catch(\Stripe\Error\InvalidRequest $e) {
            $response['success'] = 0;
            $response['message'] = 'Your card was declined. Please, check your card details.';
            return $response;
        }
        if(isset($charge['balance_transaction'])):
            $response['success'] = 1;
            $response['message'] = $charge['balance_transaction'];
            return $response;
        else:
            $response['success'] = 0;
            $response['message'] = 'Sorry your transaction fail. Please try again.';
            return $response;
        endif;
    }
    else
    {
        $response['success'] = 0;
        $response['message'] = "Please, set the Your Payment Informations.";
        return $response;
    }
}
