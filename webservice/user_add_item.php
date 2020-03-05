<?php

header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") {

    if (isset($_REQUEST['User_Id']) && isset($_REQUEST['Item_Name']) && isset($_REQUEST['Item_Condition']) && isset($_REQUEST['Item_Size']) && isset($_REQUEST['Item_Availability']) && isset($_REQUEST['Brand_Id']) && isset($_REQUEST['Item_NormalPrice']) && isset($_REQUEST['Item_Type']) ) {
        $response = array();
        include "db.php";
        include "function.php";
        $User_Id = $_REQUEST['User_Id'];
        $Item_Name = $_REQUEST['Item_Name'];
       
        $Item_Condition = $_REQUEST['Item_Condition'];
        $Item_Size = $_REQUEST['Item_Size'];
        $Item_Availability = $_REQUEST['Item_Availability'];
        $Brand_Id= $_REQUEST['Brand_Id'];
        $Item_NormalPrice = $_REQUEST['Item_NormalPrice'];
        
        $Item_Type = $_REQUEST['Item_Type'];
        
        $created = date("Y-m-d H:i:s");
 
        $target_path = "../Items/";

        $extension = explode('.', $_FILES['Item_FrontPicture']['name']);
        $Item_FrontPicture = uniqFileNameGenerator($_FILES['Item_FrontPicture']);
        $destinationPath = $target_path . $Item_FrontPicture;
        move_uploaded_file($_FILES['Item_FrontPicture']['tmp_name'], $destinationPath );       


        $extension = explode('.', $_FILES['Item_BackPicture']['name']);
        $Item_BackPicture = uniqFileNameGenerator($_FILES['Item_BackPicture']);
        $destinationPath = $target_path . $Item_BackPicture;
        move_uploaded_file($_FILES['Item_BackPicture']['tmp_name'], $destinationPath);    

        $extension = explode('.', $_FILES['Item_SidePicture']['name']);
        $Item_SidePicture = uniqFileNameGenerator($_FILES['Item_SidePicture']);
        $destinationPath = $target_path . $Item_SidePicture;
        move_uploaded_file($_FILES['Item_SidePicture']['tmp_name'], $destinationPath);

        $extension = explode('.', $_FILES['Item_InsideTagPicture']['name']);
        $Item_InsideTagPicture = uniqFileNameGenerator($_FILES['Item_InsideTagPicture']);
        $destinationPath = $target_path . $Item_InsideTagPicture;
        move_uploaded_file($_FILES['Item_InsideTagPicture']['tmp_name'], $destinationPath);

        $extension = explode('.', $_FILES['Item_BoxPicture']['name']);
        $Item_BoxPicture = uniqFileNameGenerator($_FILES['Item_BoxPicture']);
        $destinationPath = $target_path . $Item_BoxPicture;
        move_uploaded_file($_FILES['Item_BoxPicture']['tmp_name'], $destinationPath); 
  
        $insert = $db->query("INSERT INTO `auction_item` (User_Id, Item_Name, Item_FrontPicture, Item_BackPicture, Item_SidePicture, Item_InsideTagPicture, Item_BoxPicture, Item_Condition, Item_Size, Item_Availability, Brand_Id, Item_NormalPrice, Item_Type, created) VALUES ('$User_Id', '$Item_Name', '$Item_FrontPicture','$Item_BackPicture','$Item_SidePicture','$Item_InsideTagPicture','$Item_BoxPicture','$Item_Condition','$Item_Size','$Item_Availability','$Brand_Id','$Item_NormalPrice','$Item_Type','$created')"); 
        $ItemID = $db->lastInsertId();
        $user=$db->query("SELECT * FROM auction_user WHERE User_Id='User_Id'");
        $feuser=$user->fetch();
        $Notification_Title='Product added';
        $Notification_Message=$feuser['User_Name']. 'added Product';
        $Notification_Type='Product add';

        $db->query("INSERT INTO `notification` (Item_Id,Admin_Id,User_Id, Notification_Title, Notification_Message,Notification_Type, created) VALUES ('$myinsert','1','$User_Id', '$Notification_Title','$Notification_Message','$Notification_Type','$created')");
        if ($insert) {

            $url = 'https://api.branch.io/v1/url';
            $mainArray =[];
            $secondArray=[];
            $secondArray['$canonical_identifier'] = 'content/item'.$ItemID;
            $secondArray['$og_title'] = 'Laced App';
            $secondArray['$og_description'] = 'Shopping Apps';
            $secondArray['$og_image_url'] = 'https://golaced.com/images/logo.png';
            $secondArray['$desktop_url'] = 'https://golaced.com/';
            $mainArray['branch_key'] = 'key_live_blEZOcpgc0Op2BAWKU5IybafEthrPkRo';
            $mainArray['campaign'] = 'Share Laced';
            $mainArray['stage'] = 'user sharing';
            $mainArray['data'] = (Object)$secondArray;
    
            $fields  =(Object)$mainArray;
            $fields_string = json_encode($fields);
            //open connection
            $ch = curl_init();
    
            //set the url, number of POST vars, POST data
            curl_setopt($ch,CURLOPT_URL, $url);          
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER,
                        array('Content-Type:application/json',
                            'Content-Length: ' . strlen($fields_string))
                        );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
            //execute post
            $result1 = curl_exec($ch);
            
            //close connection
            curl_close($ch);
            $result = json_decode($result1,true);
            $url = $result[url];
            $identity = explode('/',$url);
            $identity = $identity[3];  
            
            $db->query("UPDATE auction_item SET Item_Identity = '$identity',Item_Link = '$url' WHERE Item_Id = '$ItemID'");

            $response['Item_Id'] = $ItemID ;
            $response['success'] = 1;
            $response['message'] = "Your Product Add Successfully";
        } else {
            $response['success'] = 0;
            $response['message'] = "Your Product Add Not Successfully";
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