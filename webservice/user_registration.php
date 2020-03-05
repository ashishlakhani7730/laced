<?php
include "db.php";
include "function.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST")
{
    if(isset($_REQUEST['User_FullName']) && isset($_REQUEST['User_Name']) && isset($_REQUEST['User_Email'])&&isset($_REQUEST['User_Password'])&&  isset($_REQUEST['User_Phone']))
    {
        $response = array();
  	    $User_FullName= $_REQUEST['User_FullName'];
        $User_Name = $_REQUEST['User_Name'];
        $User_Email = $_REQUEST['User_Email'];
        $User_Password = $_REQUEST['User_Password'];
        $User_Phone = $_REQUEST['User_Phone']; 
        $Shipping_Address= $_REQUEST['Shipping_Address']; 
            
        
        $created = date("Y-m-d H:i:s");
        
        if(!empty($_FILES))
        {
            $target_path = "../Items/";

            $extension = explode('.', $_FILES['User_ProfilePic']['name']);
            $User_ProfilePic= uniqFileNameGenerator($_FILES['User_ProfilePic']);
            $destinationPath = $target_path . $User_ProfilePic;
            move_uploaded_file($_FILES['User_ProfilePic']['tmp_name'], $destinationPath );     
        }
        else
        {
            $User_ProfilePic = "default_image.png";
        }

        $query = $db->query("SELECT * from auction_user where User_Email = '$User_Email' OR User_Name = '$User_Name'");
        if($query->rowCount() > 0)
        {   
            $sequery = $query->fetch();
            if($sequery['User_Name'] == $User_Name):
                $response['success'] = 0;
                $response['message'] = "UserName is already Exist, Please try again";
            else:        
                $response['success'] = 0;
                $response['message'] = "Email address is already Exist, Please try again";
            endif;
        }        
        else
        {       
            $insert = $db->query("INSERT INTO `auction_user` (User_FullName,User_Name, User_Email,User_Password,User_Phone,User_ProfilePic,  created) VALUES ('$User_FullName','$User_Name', '$User_Email','$User_Password', '$User_Phone', '$User_ProfilePic','$created')");
        
            $myinsert = $db->lastInsertId();
            $Notification_Title='User Register';
            $Notification_Message=$User_Name .' '. 'Register in Laced';
            $Notification_Type='User Register';

            $db->query("INSERT INTO `notification` (Admin_Id,User_Id, Notification_Title, Notification_Message,Notification_Type, created) VALUES ('1','$myinsert', '$Notification_Title','$Notification_Message','$Notification_Type','$created')");

            $url = 'https://api.branch.io/v1/url';
            $mainArray =[];
            $secondArray=[];
            $secondArray['$canonical_identifier'] = $myinsert;
            $secondArray['$og_title'] = 'Laced App';
            $secondArray['$og_description'] = 'Shopping Apps';
            $secondArray['$og_image_url'] = 'https://golaced.com/images/logo.png';
            $secondArray['$desktop_url'] = 'https://golaced.com/';
            $mainArray['branch_key'] = 'key_live_blEZOcpgc0Op2BAWKU5IybafEthrPkRo';
            $mainArray['campaign'] = 'Apps Marketings';
            $mainArray['stage'] = 'new user';
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
            $result = json_decode($result1,true);
	        $url = $result[url];
	        $identity = explode('/',$url);
            $identity = $identity[3];
            //close connection
            curl_close($ch);
            if($insert)
            {

                $db->query("UPDATE auction_user SET User_Url = '$url',User_Identity = '$identity' WHERE User_Id = '$myinsert'");
                $response['success'] = 1;
                $response['User_Id'] = $myinsert;                
                $response['message'] = "Registration successfully complate.";
            }
            else
            {
                $response['success'] = 0;
                $response['message'] = "Registration is Not Successfully Done";
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