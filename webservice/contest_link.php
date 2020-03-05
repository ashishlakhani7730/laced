<?php
include "db.php";
include "function.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];

if ($REQUEST == "POST")
{
    if(isset($_REQUEST['User_Id']) && isset($_REQUEST['Contest_Id']))
    {
        $response = array();
  	    $User_Id= $_REQUEST['User_Id'];
        $Contest_Id = $_REQUEST['Contest_Id']; 
        $created = date("Y-m-d H:i:s");
        
        $query = $db->query("SELECT * from contest_user where User_Id = '$User_Id' AND Contest_Id = '$Contest_Id'");
        if($query->rowCount() > 0)
        {   
            $sequery = $query->fetch();  
            $response['success'] = 1;
            $response['Contest_Url'] = $sequery['Contest_Url'];
            $response['message'] = "Contest Link";
        }        
        else
        {       

            $url = 'https://api.branch.io/v1/url';
            $mainArray =[];
            $secondArray=[];
            $secondArray['$canonical_identifier'] = 'content/contest'.$Contest_Id.$User_Id;
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
            $insert = $db->query("INSERT INTO contest_user(Contest_Id, User_Id, Contest_Url,Contest_Identity, created) VALUES('$Contest_Id','$User_Id','$url','$identity','$created')");
            if($insert)
            {                
                $response['success'] = 1;
                $response['Contest_Url'] = $url;                
                $response['message'] = "Contest Link";
            }
            else
            {
                $response['success'] = 0;
                $response['message'] = "Your Contest Link not Genrate. Please try again.";
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