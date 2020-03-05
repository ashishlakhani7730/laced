<?php

header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") {

    if (isset($_REQUEST['User_Id']) ) {
        $response = array();
        include "db.php";
        include "function.php";
        $User_Id = $_REQUEST['User_Id'];

        $policy = $db->query("SELECT * FROM fpolicy");
        if ($policy->Rowcount() > 0) {
            $i = 0;
            $d = '';
            $ph = array();
            
           
            while ($fepolicy = $policy->fetch()) {
                $ph[$i]["F_Id"] = $fepolicy['F_Id'];
                $ph[$i]["Admin_Id"] = $fepolicy['Admin_Id'];
                $ph[$i]["fee_policy"] = $fepolicy['fpolicy'];

                $ph[$i]["created"] = ago($fepolicy['created']);

                
                $i++;
            }
            if (sizeof($ph) > 0) {
                $response['success'] = 1;
                $response['FeePolicy'] = $ph;
                $response['message'] = "Fee Policy found";
            } else {
                $response['success'] = 0;
                $response['message'] = "Fee Policy Not found";
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