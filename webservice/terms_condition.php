<?php

header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") {

    if (isset($_REQUEST['User_Id'])   ) {
        $response = array();
        include "db.php";
        include "function.php";
        $User_Id = $_REQUEST['User_Id'];
        
        
        $created = date("Y-m-d H:i:s");


        $term = $db->query("SELECT * FROM tandc");
        if ($term->Rowcount() > 0) {
            $i = 0;
            $d = '';
            $ph = array();
           
            while ($feterm = $term->fetch()) {
                $ph[$i]["T_id"] = $feterm['T_id'];
                $ph[$i]["Admin_Id"] = $feterm['Admin_Id'];
                $ph[$i]["tremscondition"] = $feterm['tremscondition'];
                
                $ph[$i]["created"] = ago($feterm['created']);

                $i++;
            }
            if (sizeof($ph) > 0) {
                $response['success'] = 1;
                $response['TermCondition'] = $ph;
                $response['message'] = "Term Condition List found";
            } else {
                $response['success'] = 0;
                $response['message'] = "Term Condition Not found";
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