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

        //$Contest_Id = $_REQUEST['Contest_Id'];
        
       
        
      


        
        $contest=$db->query("SELECT *  FROM `contest`  order by Contest_Id DESC");
        if ($contest->Rowcount() > 0) {
            $ph = array();
            $i = 0;
            $d = '';
            $current_date = date("Y-m-d H:i:s");
            while ($fecontest = $contest->fetch()) {
                
                // $contestDetails = $db->query("SELECT *  FROM `contest` WHERE Contest_Id='".$fecontest['Contest_Id']."'");
                // $fecontestDetails = $contestDetails->fetch();
                
                $item = $db->query("SELECT *  FROM `auction_item` WHERE Item_Id='".$fecontest['Item_Id']."'");
                $feitem = $item->fetch();
                
                $tmpCurrent_date = strtotime(date("Y-m-d H:i:s"));
                $tmpStart_date = strtotime($fecontest['Start_Date']);
                $tmpEnd_date = strtotime($fecontest['End_Date']);

                $now = new DateTime();
                $future_date = new DateTime($fecontest['End_Date']);
                $interval = $future_date->diff($now);
                $interval->format("%a days, %h hours, %i minutes, %s seconds");
                
                $user = $db->query("select * from auction_user ");
                $feuser = $user->fetch();

                if (($tmpCurrent_date >= $tmpStart_date) && ($tmpCurrent_date <= $tmpEnd_date)):

                        $ph[$i]["Contest"] = "LIVE";
                        $ph[$i]["EndingIn"] = $interval->format("%a,%h,%i,%s");
                elseif ($tmpCurrent_date > $tmpEnd_date):
			
                        $ph[$i]["Contest"] = "ENDED";
                        
                        $Cuser=$db->query("SELECT *  FROM `contest_user` WHERE Contest_Id ='".$fecontest['Contest_Id']."' AND Winner ='1'");
                        $feCuser=$Cuser->fetch();
                        
                        $User=$db->query("SELECT *  FROM `auction_user` WHERE User_Id ='".$feCuser['User_Id']."'");
                        $feUser = $User->fetch();
                        	$ph[$i]['Winner'] =  $feUser ['User_Name']!= '' ?$feUser ['User_Name']:'';
                        // if($feCuser['Contest_Id']== $fecontest['Contest_Id']  && $feCuser['Winner'] =='1'  ):
                        // // 	$feUser = $User->fetch();
                        // // 	$ph[$i]['Winner'] = $feUser ['User_Name'];
                        // endif;
                        
                        
                        
                        
                        
                elseif ($tmpCurrent_date < $tmpStart_date):

                        $ph[$i]["Contest"] = "UPCOMING";
                else:

                        $ph[$i]["Contest"] = "ENDED";
                        
                endif;
                
                
                $ph[$i]["Contest_Id"] = $fecontest['Contest_Id'];
                //$ph[$i]["Contest_Link"] = $feCuser['Contest_Url'];
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

                $ph[$i]["Item_NormalPrice"] =  $feitem['Item_NormalPrice'] ;
                $ph[$i]["Item_Condition"] = $feitem['Item_Condition'];
                $ph[$i]["Item_Size"] = $feitem['Item_Size'];
                $ph[$i]["Item_MarketPrice"] =  $feitem['Item_MarketPrice'] !='' ? $feitem['Item_MarketPrice'] :'' ;
                
                $Point = 0;
                $cuser = $db->query("select * from contest_user where  Contest_Id = '".$fecontest['Contest_Id']."' AND  User_Id !=$User_Id  ");
                while($fecuser = $cuser->fetch())
                {
                $Share = $fecuser ['Contest_Share'] * 3;
                $Install =  $fecuser ['Contest_Install'] * 5;
                $Point = $Point + $Share + $Install;
                }
                $ph[$i]["No_Of_Entries"] =$Point ;



    
                $cuser1 = $db->query("select * from contest_user where Contest_Id = '".$fecontest['Contest_Id']."' and User_Id =$User_Id");
                $fecuser1 = $cuser1->fetch();
                $Share1 = $fecuser1 ['Contest_Share'] * 3;
                $Install1 =  $fecuser1 ['Contest_Install'] * 5;
                $Point1 = $Share1 + $Install1;
                
                $ph[$i]["Your_Entries"] = $Point1  ;
                


                
                

                        $i++;
                    }
                    if (sizeof($ph) > 0) {

                        $response['success'] = 1;

                        $response['ContestList'] = $ph;
                        
                        $response['message'] = "Contest List found";
                    } else {
                        $response['success'] = 0;
                        $response['message'] = "No listings Availabl";
                    }
                } else {
                    $response['success'] = 0;
                    $response['message'] = "No listings Availabl";
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
