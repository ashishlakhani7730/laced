<?php

header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") {

    if (isset($_REQUEST['User_Id'])) {
        include "db.php";
        include "function.php";
        $response = array();
        $User_Id = $_REQUEST['User_Id'];
        $created = date("Y-m-d H:i:s");


        $favorite = $db->query("SELECT * FROM favorite WHERE User_Id='$User_Id'");
        if ($favorite->Rowcount() > 0) {
            $i = 0;
            $d = '';
            $ph = array();


            while ($fefavorite = $favorite->fetch()) {
                $item = $db->query("SELECT * FROM auction_item where Item_Id='" . $fefavorite['Item_Id'] . "'");
                $feitem = $item->fetch();
                $ph[$i]["Favorite_Id"] = $fefavorite['Favorite_Id'];
                $ph[$i]["Item_Id"] = $fefavorite['Item_Id'];
                $ph[$i]["Item_Name"] = $feitem['Item_Name'];
                $image=$db->query("SELECT * FROM auction_item WHERE Item_Id ='".$feitem['Item_Id']."'");
                $feimage=$image->fetch();
                $m = 0;
                    
                    $im = array();
                        
                        $im[$m]["Item_FrontPicture"] = $feimage['Item_FrontPicture'] != '' ? $DefaultUrl . $feimage['Item_FrontPicture'] :'';
                        $im[$m]["Item_BackPicture"] = $feimage['Item_BackPicture'] != '' ? $DefaultUrl . $feimage['Item_BackPicture'] : '';
                        $im[$m]["Item_SidePicture"] = $feimage['Item_SidePicture'] != '' ? $DefaultUrl . $feimage['Item_SidePicture'] : '';
                        $im[$m]["Item_InsideTagPicture"] = $feimage['Item_InsideTagPicture'] != '' ? $DefaultUrl . $feimage['Item_InsideTagPicture'] : '';
                        $im[$m]["Item_BoxPicture"] = $feimage['Item_BoxPicture'] != '' ? $DefaultUrl . $feimage['Item_BoxPicture'] : '';
                        
                        $m++;
                        
                    
                    
                    $ph[$i]["ImageList"] = $im;
                $ph[$i]["Item_Condition"] = $feitem['Item_Condition']!= '' ? $feitem['Item_Condition']:'';
                $ph[$i]["Item_Size"] = $feitem['Item_Size'] !='' ? $feitem['Item_Size'] : '';
                $ph[$i]["Item_Availability"] = $feitem['Item_Availability'];
                $brand = $db->query("select * from auction_brand where Brand_Id='" . $feitem['Brand_Id'] . "'");
                $febrand = $brand->fetch();
                $ph[$i]["Brand_Name"] = $febrand['Brand_Name']  !='' ? $febrand['Brand_Name'] : '';
                
                $user = $db->query("SELECT * FROM auction_user where User_Id='" . $fefavorite['User_Id'] . "'");
                $feuser = $user->fetch();
                $ph[$i]["User_Id"] = $fefavorite['User_Id'];
                $ph[$i]["User_Name"] = $feuser['User_Name'];
                $ph[$i]['User_ProfilePic'] = $feuser['User_ProfilePic'] != '' ? $DefaultUrl . $feuser['User_ProfilePic'] : '' ;
                $ph[$i]["created"] = ago($fefavorite['created']);


                $i++;
            }
            if (sizeof($ph) > 0) {
                $response['success'] = 1;
                $response['Favorite_List'] = $ph;
                $response['message'] = "Favorite List found";
            } else {
                $response['success'] = 0;
                $response['message'] = "No list found";
            }
        } else {
            $response['success'] = 0;
            $response['message'] = "No list found";
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