<?php
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST")
{
    if(isset($_REQUEST['User_Id']))
    {
        $response = array();
        include "db.php";

        $User_Id = $_REQUEST['User_Id'];

        $bank = $db->query("SELECT * FROM user_bank_info WHERE User_Id = '$User_Id'");
        
        if($bank->Rowcount() > 0)
        {
            $bankdetail = $bank->fetch();
        	$response['success'] = 1;
	        $response['message'] = "BankInfo";
	        $response['BankInfo_Id'] = $bankdetail['BankInfo_Id'];
	        $response['BanInfo_Type'] = $bankdetail['BanInfo_Type'];
	        $response['Bank_Name'] = $bankdetail['Bank_Name'] != '' ? $bankdetail['Bank_Name'] : '';
	        $response['Account_Number'] = $bankdetail['Account_Number'] != '' ? $bankdetail['Account_Number'] : '';
	        $response['Routing_Number'] = $bankdetail['Routing_Number'] != '' ? $bankdetail['Routing_Number'] : '';
	        $response['Date_of_Birth'] = $bankdetail['Date_of_Birth'] != '' ? $bankdetail['Date_of_Birth'] : '';
	        $response['Account_HolderName'] = $bankdetail['Account_HolderName'] != '' ? $bankdetail['Account_HolderName'] : '';
	        $response['Card_No'] = $bankdetail['Card_No'] != '' ? $bankdetail['Card_No'] : '';
	        $response['Expiry_Data'] = $bankdetail['Expiry_Data'] != '' ?  $bankdetail['Expiry_Data'] : '';
	        $response['Cvv_Code'] = $bankdetail['Cvv_Code'] != '' ? $bankdetail['Cvv_Code'] : '';
	        $response['created'] = $bankdetail['created'];;
        }
        else
        {
        	$response["success"] = 0;
        	$response["message"] = "Sorry Please,fill you bank Informations";
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