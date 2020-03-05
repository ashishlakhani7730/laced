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

        //$Raffle_Id = $_REQUEST['Raffle_Id'];
        
       
        
      $user1=$db->query("select * from raffle_user where User_Id='$User_Id'");
      


        
        $raffle=$db->query("SELECT *  FROM `raffle`  order by Raffle_Id DESC");
        if ($raffle->Rowcount() > 0) {
            $ph = array();
            $i = 0;
            $d = '';
            $current_date = date("Y-m-d H:i:s");
            while ($feraffle = $raffle->fetch()) {
                
                $item = $db->query("SELECT *  FROM `auction_item` WHERE Item_Id='".$feraffle[Item_Id]."'");
                $feitem = $item->fetch();
                
                $tmpCurrent_date = strtotime(date("Y-m-d H:i:s"));
                $tmpStart_date = strtotime($feraffle['Start_Date']);
                $tmpEnd_date = strtotime($feraffle['End_Date']);

                $now = new DateTime();
                $future_date = new DateTime($feraffle['End_Date']);
                $interval = $future_date->diff($now);
                $interval->format("%a days, %h hours, %i minutes, %s seconds");
                
                $user = $db->query("select * from auction_user ");
                $feuser = $user->fetch();

                if (($tmpCurrent_date >= $tmpStart_date) && ($tmpCurrent_date <= $tmpEnd_date)):

                        $ph[$i]["Raffle"] = "LIVE";
                        $ph[$i]["EndingIn"] = $interval->format("%a,%h,%i,%s");
                elseif ($tmpCurrent_date > $tmpEnd_date):
			
                        $ph[$i]["Raffle"] = "ENDED";
                        
                        $Ruser=$db->query("SELECT *  FROM `raffle_user` WHERE Raffle_Id ='".$feraffle['Raffle_Id']."' AND Item_Id ='".$feraffle['Item_Id']."' AND Winner ='1'");
                        $feRuser=$Ruser->fetch();
                        
                        $User=$db->query("SELECT *  FROM `auction_user` WHERE User_Id ='".$feRuser['User_Id']."'");
                        $feUser = $User->fetch();
                        $ph[$i]['Winner'] = $feUser ['User_Name']!= '' ?$feUser ['User_Name']:'';
//                        if($feRuser['Raffle_Id']== $feraffle['Raffle_Id'] && $feRuser['Item_Id']==$feraffle['Item_Id'] && $feRuser['Winner'] =='1'  ):
//                        	
//                        endif;
                        
                        
                        
                        
                        
                elseif ($tmpCurrent_date < $tmpStart_date):

                        $ph[$i]["Raffle"] = "UPCOMING";
                else:

                        $ph[$i]["Raffle"] = "ENDED";
                        
                endif;
                
                
                $ph[$i]["Raffle_Id"] = $feraffle['Raffle_Id'];
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
                $ph[$i]["Item_MarketPrice"] =  $feitem['Item_MarketPrice'] ;

                $feuser1=$user1->fetch();

   $ruser1 = $db->query("select * from raffle_user where Raffle_Id = '".$feraffle['Raffle_Id']."' and User_Id ='".$feuser1['User_Id']."'");
                $feruser1 = $ruser1->fetch();
                $UserEntry = 0;
                 
                while ($feruser1 = $ruser1 ->fetch()) {
                    $UserEntry = $UserEntry + $feruser1['Raffle_Status'];
                    
                }
                $ph[$i]["User_Entries"] = $UserEntry  ;
                


                $User_Id=$feuser['User_Id'];
                $ruser = $db->query("select * from raffle_user where  Raffle_Id = '".$feraffle['Raffle_Id']."'  OR User_Id ='".$feuser['User_Id']."'");
                $feruser = $ruser->fetch();
                $TotalUser = 0;
                
                while ($feruser  = $ruser ->fetch()) {
                    $TotalUser = $TotalUser + $feruser ['Raffle_Status'];
                    
                }
                $ph[$i]["No_Of_Entries"] =$TotalUser ;

                

                $ph[$i]["Raffle_EntryPrice"] = $feraffle['Raffle_Price'];
               

                        $i++;
                    }
                    if (sizeof($ph) > 0) {

                        $response['success'] = 1;

                        $response['RaffleList'] = $ph;
                        
                        $response['message'] = "Raffle List found";
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
