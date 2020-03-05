<?php
header('Content-Type: application/json');
 include "db.php";
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST")
{
    if(isset($_REQUEST['User_Id']) && isset($_REQUEST['UpdateBank']) && $_REQUEST['User_Id'] != '' && $_REQUEST['UpdateBank'] != '' && $_REQUEST['Bank_HolderName'] != '' && $_REQUEST['DOB'] != '' && $_REQUEST['Address'] != '' && $_REQUEST['User_UnitNo'] != '' && $_REQUEST['User_State'] != '' && $_REQUEST['SSN4'] != '' && $_REQUEST['Routing_Number'] != '' && $_REQUEST['Account_Number'] != '')
    {
        $response = array();
       
  
        $User_Id = $_REQUEST['User_Id'];
        $Bank_HolderName= $_REQUEST['Bank_HolderName'];
        $DOB = $_REQUEST['DOB'];
        $Address = $_REQUEST['Address']; 
        $User_UnitNo= $_REQUEST['User_UnitNo'];
        $User_State = $_REQUEST['User_State'];
        $SSN4 = $_REQUEST['SSN4'];
        $Routing_Number = $_REQUEST['Routing_Number'];
        $Account_Number = $_REQUEST['Account_Number'];
        $bankupdate = $_REQUEST['UpdateBank'];
        $created = date("Y-m-d H:i:s");
        
        $user=$db->query("select * from auction_user where User_Id='$User_Id'");
        $feuser=$user->fetch();

        if($feuser['User_verified'] == '1')
        {
              $response['verified_User'] = $DefaultPath. 'verify.png';
        }
           


            
        if($bankupdate == 0)
        {
               $insert = $db->query("INSERT INTO `auction_user_bank_info` (User_Id,Bank_HolderName, DOB, Address, User_UnitNo ,User_State,SSN4,Routing_Number, Account_Number,created) VALUES ('$User_Id','$Bank_HolderName', '$DOB', '$Address', '$User_UnitNo', '$User_State','$SSN4','$Routing_Number','$Account_Number','$created')");

                $myinsert = $db->lastInsertId(); 
               if($insert)
                { 
                    $response['success'] = 1;               
                    $response['message'] = "your bank details submitted";
                }
                else
                {
                    $response['success'] = 0;
                    $response['message'] = "your bank details not submitted";
                } 
        }
        else if($bankupdate == 1)
        {
            $update = $db->query("UPDATE `auction_user_bank_info` SET User_Id = '$User_Id', Bank_HolderName = '$Bank_HolderName' , DOB = '$DOB', Address = '$Address', User_UnitNo = '$User_UnitNo', User_State = '$User_State',SSN4 = '$SSN4',Routing_Number = '$Routing_Number', Account_Number = '$Account_Number',modified = '$created'");
             
                if($update)
                { 
                    $response['success'] = 1;               
                    $response['message'] = "your bank details Update Sucessfully";
                }
                else
                {
                    $response['success'] = 0;
                    $response['message'] = "your bank details not Updated";
                }
        }
        else
        {
            $response["success"] = 0;
            $response["message"] = "Please Provide update detail";
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