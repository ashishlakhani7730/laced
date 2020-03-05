<?php

include "db.php";
include "function.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];

if ($REQUEST == "POST") {

    if ( isset($_REQUEST['User_Id']) ) {

        $response = array();
        $User_Id = $_REQUEST['User_Id'];
       
        

        $item = $db->query("SELECT *  FROM `auction_item` WHERE User_Id='$User_Id' AND Item_Status = '1'");

        if ($item->Rowcount() > 0) {
            $ph = array();
            $i = 0;
            $d = '';
            $current_date = date("Y-m-d H:i:s");
            while ($feitem = $item->fetch()) {
                
                $ph[$i]["Item_Id"] = $feitem['Item_Id'];
                $brand = $db->query("select * from auction_brand where Brand_Id='" . $feitem['Brand_Id'] . "'");
                $febrand = $brand->fetch();
                $ph[$i]["Brand_Name"] = $febrand['Brand_Name'];
                $image=$db->query("SELECT * FROM auction_item WHERE Item_Id ='".$feitem['Item_Id']."'");
                $feimage=$image->fetch();
                $m = 0;
                    
                    $im = array();
                        
                        $im[$m]["Item_FrontPicture"] = $feimage['Item_FrontPicture'] != '' ? $DefaultUrl . $feimage['Item_FrontPicture'] : $feimage['Item_FrontPicture'];
                        $im[$m]["Item_BackPicture"] = $feimage['Item_BackPicture'] != '' ? $DefaultUrl . $feimage['Item_BackPicture'] : $feimage['Item_BackPicture'];
                        $im[$m]["Item_SidePicture"] = $feimage['Item_SidePicture'] != '' ? $DefaultUrl . $feimage['Item_SidePicture'] : $feimage['Item_SidePicture'];
                         $im[$m]["Item_InsideTagPicture"] = $feimage['Item_InsideTagPicture'] != '' ? $DefaultUrl . $feimage['Item_InsideTagPicture'] : $feimage['Item_InsideTagPicture'];
                          $im[$m]["Item_BoxPicture"] = $feimage['Item_BoxPicture'] != '' ? $DefaultUrl . $feimage['Item_BoxPicture'] : $feimage['Item_BoxPicture'];
                        
                        $m++;
                        
                    
                    
                    $ph[$i]["ImageList"] = $im;
                
                
                
                $ph[$i]["Item_Name"] = $feitem['Item_Name'];



                $ph[$i]["Item_Condition"] = $feitem['Item_Condition'];
                $ph[$i]["Item_Size"] = $feitem['Item_Size'];
                $ph[$i]["Item_MarketPrice"] = $feitem['Item_MarketPrice'] ;
		$ph[$i]["Item_Type"] = $feitem['Item_Type'] ;
		
                $user = $db->query("select * from auction_user where User_Id='" . $feitem['User_Id'] . "'");
                $feuser = $user->fetch();
                 
                 $ph[$i]["User_Id"] = $feuser['User_Id'];
                    $ph[$i]["User_name"] = $feuser['User_Name'];
                    $ph[$i]['User_ProfilePic'] = $feuser['User_ProfilePic'] != '' ? $DefaultUrl . $feuser['User_ProfilePic'] : '';
                    
                    $follow = $db->query("SELECT * FROM follow WHERE User_Id_One = '" . $feuser ['User_Id'] . "' OR User_Id_Two= '" . $feuser ['User_Id'] . "'");
                $TotalFollower = 0;
                
                while ($fefollow = $follow ->fetch()) {
                    $TotalFollower = $TotalFollower  + $fefollow ['Follow_Status'];
                    
                }
                $ph[$i]["Follower"] =  $TotalFollower ;  

                

                        $i++;
                    }
                    if (sizeof($ph) > 0) {

                        $response['success'] = 1;

                        $response['ItemList'] = $ph;
                        
                        $response['message'] = "Item List found";
                    } else {
                        $response['success'] = 0;
                        $response['message'] = "No List found";
                    }
                } else {
                    $response['success'] = 0;
                    $response['message'] = "No history found";
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
