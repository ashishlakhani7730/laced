<?php

include "db.php";
include "function.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") {
    if (isset($_REQUEST['User_Id'])) {

        $response = array();

        $User_Id = $_REQUEST['User_Id'];



        $Faq = $db->query("SELECT * FROM `faq`");

        if ($Faq->Rowcount() > 0) {
            $i = 0;
            $d = '';
            $ph = array();

            while ($feFaq = $Faq->fetch()) {

                $ph[$i]["F_Id"] = $feFaq['F_Id'];
                $ph[$i]["Admin_Id"] = $feFaq['Admin_Id'];
                $ph[$i]["question"] = htmlentities($feFaq['question'], ENT_IGNORE);
                $ph[$i]["answer"] = htmlentities($feFaq['answer'], ENT_IGNORE);
                $i++;
            }
            if (sizeof($ph) > 0) {
                $response['success'] = 1;
                $response['Faq'] = $ph;
                $response['message'] = "Faq List found";
            } else {
                $response['success'] = 0;
                $response['message'] = "No List found";
            }
        } else {
            $response['success'] = 0;
            $response['message'] = "No List found";
        }
    } else {
        $response["success"] = 0;
        $response["message"] = "Fields are missing";
    }
} else {
    $response["success"] = 0;
    $response["message"] = "Invalid Request Type(Use POST Method)";
}
//echo "<pre>";
//print_r($response);
//die;
echo json_encode($response);
?>
