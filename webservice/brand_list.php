<?php

include "db.php";
include "function.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") {
    if (isset($_REQUEST['User_Id']) ) {

        $response = array();

        $User_Id = $_REQUEST['User_Id'];
        


        $brand = $db->query("SELECT * FROM `auction_brand` order by Brand_Id DESC ");

        if ($brand ->Rowcount() > 0) {
            $i = 0;
            $d = '';
            $ph = array();

            while ($febrand = $brand->fetch()) {


                $ph[$i]["Brand_Id"] = $febrand['Brand_Id'];
                $ph[$i]["Brand_Name"] = $febrand['Brand_Name'];
               
                $ph[$i]['Brand_Logo'] = $febrand['Brand_Logo'] != '' ? $DefaultPath.  $febrand['Brand_Logo'] : '';
                
                
                $i++;
            }
            if (sizeof($ph) > 0) {
                $response['success'] = 1;
                $response['BrandList'] = $ph;
                $response['message'] = "Brand List found";
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
echo json_encode($response);
?>
