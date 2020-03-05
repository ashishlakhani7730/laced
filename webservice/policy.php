<?php

header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") {

    if (isset($_REQUEST['User_Id'])){ 
        include "db.php";
        include "function.php";
        $User_Id = $_REQUEST['User_Id'];
        $created = date("Y-m-d H:i:s");


        $policy = $db->query("SELECT * FROM policy");
        if ($policy->Rowcount() > 0) {
            $i = 0;
            $d = '';
            $ph = array();
            
           
            while ($fepolicy = $policy->fetch()) {
                $ph[$i]["P_Id"] = $fepolicy['P_Id'];
                $ph[$i]["Admin_Id"] = $fepolicy['Admin_Id'];
                $ph[$i]["policy"] = $fepolicy['policy'];
                $ph[$i]["created"] = ago($fepolicy['created']);

               
                $i++;
            }
            if (sizeof($ph) > 0) {
                $response['success'] = 1;
                $response['Policy'] = $ph;
                $response['message'] = "Privacy Policy Found ";
            } else {
                $response['success'] = 0;
                $response['message'] = "Privacy policy Not found";
            }
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