<?php

header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") {

    if (isset($_REQUEST['Brand_Name'])  ) {
        $response = array();
        include "db.php";
        include "function.php";
        $Brand_Name = $_REQUEST['Brand_Name'];
        $created = date("Y-m-d H:i:s");
         $target_path = "../uploads/brand/";

        $extension = explode('.', $_FILES['Brand_Logo']['name']);
        $Brand_Logo = uniqFileNameGenerator($_FILES['Brand_Logo']);
        $destinationPath = $target_path . $Brand_Logo;
        move_uploaded_file($_FILES['Brand_Logo']['tmp_name'], $destinationPath );
        
        $insert = $db->query("INSERT INTO `auction_brand` (Brand_Name, Brand_Logo, created) VALUES 
                                                                ('$Brand_Name', '$Brand_Logo', '$created')");
        $myinsert = $db->lastInsertId();
       
        if ($insert) {
            $response['Brand_Id'] = $myinsert ;
            $response['success'] = 1;
            $response['message'] = "Brand added Successfully";
        } else {
            $response['success'] = 0;
            $response['message'] = "Brand Not added Successfully";
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