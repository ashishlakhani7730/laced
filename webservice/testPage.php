<?php 



    // for($i=0;$i<50;$i++){


    // // $token='eLhbw3geSHU:APA91bF_8L2_pAEiMHhJGgVSwXL0bnPqlfAswj83CCpNlo0_onbs488sdu8eOep3Giak2hXwpkil-GAHHauHQKCfelPoaCFqbj-F3_NEui9SE08Of9w1Hhw64zSJNWFC9owSSIQVHUc8nK1YWHfzyqSKfPO04xD9Zw';
    // $token='ewuMTui9biE:APA91bEEILsSIdZBdqZb-tcxq3bQ5Iq_233xRzI6Rx9OQStrIKSDKHrtwN2r-sj4tnwFL0bDSeMzmwyQ6UBS-Myq523bVFxNTRcwJpEKN6HDw-soFh3NIf0Trykx3Pwbk5cqciYkSCcDhAtBkfs8aIyKUJvj3whXJQ';
    // // $token='cQxDPzejaw0:APA91bENc7kETEZUiZD8RMDw_3R_0KgPhCBAyMfbmqYgcGN5tkHftywhy6iDnPMKVes4Yk92VP2pR2jOcCdJtGh2drgZFXwt2E4luYKwgK4LYjSfEwPm2AyTle9lptTC_QH4ZOq6vq_TVDac4WUIySWWwHkzI_WwyQ';

    // $title='TEST PUSH';
    // $messageBody='TEST PUSH BODY OK';

    // $url = "https://fcm.googleapis.com/fcm/send";
    // // $arrayToSend = array('to' => $registrationId, 'data' => $data,'priority'=>'high');
    // $arrayToSend = array('to' => $token, 'notification' => array("title" => $title,"body" => $messageBody,"sound" => "default"),'priority'=>'high');

    // // $arrayToSend = array('to' => $registrationId, 'notification' => array("title" => $title,"body" => $data,"sound" => "default"),'priority'=>'high');
    // $json = json_encode($arrayToSend);
    
    // $headers = array();
    // $headers[] = 'Authorization: key= AAAAaEhUflA:APA91bFDj9_1RHuC56RWPzn6jcpcaMEv2M6GYmPOQUoHl0D-ZXsPmIDUqU1UKUBl7FRpyy07A9T8MRjdUj9NwcA3Y45tlja6etmqBZj8Q3UsMQzZeM5z5Ly_FVgwifG8yta_epKKWVXs3WZAvfEX5r8cVAeTA2mdQQ';
    // $headers[] = 'Content-Type: application/json';

    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, $url);
    // curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    // curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // //Send the request
    // $response = curl_exec($ch); 

   
    // curl_close($ch);

    // echo $i;

    // }