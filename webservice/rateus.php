<?php
include "db.php";
header('Content-Type: application/json');
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") {

    if (isset($_REQUEST['User_Id']) && isset($_REQUEST['ratingnumber']) && isset($_REQUEST['Review']) ) {
        $response = array();
        $User_Id = $_REQUEST['User_Id'];
        $ratingnumber= $_REQUEST['ratingnumber'];
        $Review= $_REQUEST['Review'];
        $check = $db->query("SELECT * FROM rateus WHERE User_Id = '$User_Id'");
        if($check->rowCount() > 0):
            $update = $db->query("UPDATE `rateus` SET ratingnumber = '$ratingnumber', Review = '$Review' WHERE User_Id = '$User_Id'");
          
            $user=$db->query("SELECT * from auction_user WHERE User_Id = '$User_Id'");
            $feuser=$user->fetch();
            if($update)
            { 
                $response['User_Id']= $User_Id;
                $response['User_Name']= $feuser['User_Name'];
                $response['rating_star']= $ratingnumber;
                $response['Review']= $Review;
                $response['success'] = 1;               
                $response['message'] = "Thank You for Your Review";
            }
            else
            {
                $response['success'] = 0;
                $response['message'] = "Try again..";
            } 
        else:
    	    $insert = $db->query("INSERT INTO `rateus` (User_Id, ratingnumber, Review) VALUES ('$User_Id', '$ratingnumber', '$Review')");
          
            $user=$db->query("SELECT * from auction_user WHERE User_Id = '$User_Id'");
            $feuser=$user->fetch();
            if($insert)
            { 
                $response['User_Id']= $User_Id;
                $response['User_Name']= $feuser['User_Name'];
                $response['rating_star']= $ratingnumber;
                $response['Review']= $Review;
                $response['success'] = 1;               
                $response['message'] = "Thank You for Your Review";
            }
            else
            {
                $response['success'] = 0;
                $response['message'] = "Try again..";
            }
        endif;
         
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