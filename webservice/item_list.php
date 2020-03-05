<?php
include "db.php";
include "function.php";
header('Content-Type: application/json');
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST") 
{
    if (isset($_REQUEST['Search_Keyword']) && isset($_REQUEST['User_Id']) && isset($_REQUEST['Item_Size']) && isset($_REQUEST['Minimum_Price']) && isset($_REQUEST['Maximum_Price']) && isset($_REQUEST['orderby']) && isset($_REQUEST['Item_Type']) && isset($_REQUEST['Item_Status']) && isset($_REQUEST['Sort'])) 
    {
        $response = array();
        $User_Id = $_REQUEST['User_Id'];
        $Search_Keyword = $_REQUEST['Search_Keyword'];

        $Item_Size = $_REQUEST['Item_Size'];

        $Maximum_Price = $_REQUEST['Maximum_Price'];
        $Minimum_Price = $_REQUEST['Minimum_Price'];
        $orderby = $_REQUEST['orderby'];
        $Sort= $_REQUEST['Sort'];
        $Item_Type = $_REQUEST['Item_Type'];
        $Item_Status= $_REQUEST['Item_Status'];
        $WHERE = array();
        $inner = $w = '';
        
       
        if ($Search_Keyword != "") {
            $WHERE[] = "(Item_Name like '%$Search_Keyword%' || Brand_Id like '%$Search_Keyword%')";
        }

        if (!empty($Item_Size)) {
            $WHERE[] = " Item_Size  like '%$Item_Size%'";
        }
	
        if (!empty($Item_Type)) {
            $WHERE[] = " Item_Type  like '%$Item_Type%'";
        }

        if (!empty($Maximum_Price) && !empty($Minimum_Price)) {
            $WHERE[] = " Item_NormalPrice     between '$Minimum_Price' and '$Maximum_Price'";
        } else if (!empty($Minimum_Price)) {
            $WHERE[] = " Item_NormalPrice  <= '$Minimum_Price'";
        } else if (!empty($Maximum_Price)) {
            $WHERE[] = " Item_NormalPrice  >= '$Maximum_Price'";
        }

        $WHERE[] =" Item_Status = 1";
        $WHERE[] =" User_Id != ".$User_Id;

	    if ($Sort== 'HighestFirst') {
            $Sort = "order by Item_NormalPrice  DESC";
        } else if ($Sort== 'LowestFirst') {
            $Sort= "order by Item_NormalPrice  ASC";
        }

        if ($orderby == 'HighToLow') {
            $orderby = "order by Item_MarketPrice DESC";
        } else if ($orderby == 'LowToHigh') {
            $orderby = "order by Item_MarketPrice ASC";
        } else if ($orderby == 'Popularity') {
            $orderby = "order by Popularity DESC";
        }

        if (sizeof($WHERE) > 0) {
            $w = implode(' AND ', $WHERE);
            $w = 'WHERE ' . $w;
        } else {
            $w = '';
        }
        $item = $db->query("SELECT *  FROM `auction_item` $w  $Sort $orderby ");

        if ($item->Rowcount() > 0) {
            $ph = array();  $i = 0;  $d = '';
            $current_date = date("Y-m-d H:i:s");
            while ($feitem = $item->fetch()) {

                $tmpCurrent_date = strtotime(date("Y-m-d H:i:s"));
                $tmpStart_date = strtotime($feitem['Item_Sale_StartDate']);
                $tmpEnd_date = strtotime($feitem['Item_Sale_EndDate']);

                $now = new DateTime();
                $future_date = new DateTime($feitem['Item_Sale_EndDate']);
                $interval = $future_date->diff($now);
                $interval->format("%a days, %h hours, %i minutes, %s seconds");

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
                $ph[$i]["Item_Link"] = $feitem['Item_Link'] ;
		
                $user = $db->query("select * from auction_user where User_Id='" . $feitem['User_Id'] . "'");
                $feuser = $user->fetch();

                $ph[$i]["Seller_Id"] = $feuser['User_Id'];
                $ph[$i]["Seller_name"] = $feuser['User_Name'];
                $ph[$i]['Seller_ProfilePic'] = $feuser['User_ProfilePic'] != '' ? $DefaultUrl . $feuser['User_ProfilePic'] : $feuser['User_ProfilePic'] ;
               
                if($feuser['User_verified'] == '1')
                {
                    $ph[$i]["Is_User_Verified"]  = 1;
                }
                else
                {
                    $ph[$i]["Is_User_Verified"]  = 0;
                }
                $follow = $db->query("SELECT * FROM follow WHERE User_Id_One = '" . $feuser ['User_Id'] . "' OR User_Id_Two= '" . $feuser ['User_Id'] . "'");
                $TotalFollower = 0;
                
                while ($fefollow = $follow ->fetch()) {
                    $TotalFollower = $TotalFollower  + $fefollow ['Follow_Status'];   
                }
                $ph[$i]["Followers"] =  $TotalFollower ;  

                $trade = $db->query("SELECT * FROM trade WHERE User_Id= '" . $feitem ['User_Id'] . "' AND Item_Id ='".$feitem['Item_Id']."' AND  Trade_Status= '1'");
                $Totaltrade = 0;
            
                while ($fetrade = $trade ->fetch()) {
                    $Totaltrade = $Totaltrade + $fetrade ['Trade_Status']; 
                }
                $ph[$i]["Traded"] =  $Totaltrade ;

                $auction = $db->query("SELECT * FROM auction_item WHERE User_Id= '" . $feuser ['User_Id'] . "' AND Item_Type= '3'");
                $Totalauction = 0;
                
                while ($feauction  = $auction ->fetch()) {
                    $Totalauction = $Totalauction + $feauction ['Item_Status'];
                }
                $ph[$i]["Auctioned"] =  $Totalauction ;

                $sold = $db->query("SELECT * FROM user_purchase_item WHERE Seller_Id= '" . $feitem ['User_Id'] . "' AND Item_Id ='" . $feitem ['Item_Id'] . "' AND Purchase= '1'");
                $Totalsold = 0;
                
                while ($fesold = $sold ->fetch()) {
                    $Totalsold  = $Totalsold + $fesold ['Purchase'];
                    
                }
                $ph[$i]["Sold"] =  $Totalsold  ;
        
                $favorite= $db->query("SELECT * FROM favorite WHERE Item_Id='".$feitem['Item_Id']."'");
                $fefavorite=$favorite->fetch();
                if($fefavorite['Favorite_Status']== '1')
                {
                    $ph[$i]["Favorite_Status"] =  "Favorite"  ;
                }
                else if($fefavorite['Favorite_Status']== '0')
                {
                    $ph[$i]["Favorite_Status"] =  "Unfavorite"  ;
                }
                else if($fefavorite['Favorite_Status']== '')
                {
                    $ph[$i]["Favorite_Status"] =  "Unfavorite"  ;
                }

                if($Item_Type == '3' ) {

                    $ph[$i]["Item_NormalPrice"] = $feitem['Item_NormalPrice'];
                    
                    if (($tmpCurrent_date >= $tmpStart_date) && ($tmpCurrent_date <= $tmpEnd_date)):

                        $ph[$i]["Auction"] = "AUCTION IS LIVE";
                        $ph[$i]["EndingIn"] = $interval->format("%a,%h,%i,%s");
                    elseif ($tmpCurrent_date > $tmpEnd_date):

                        $ph[$i]["Auction"] = "AUCTION IS ENDED";
                            
                        $auser=$db->query("SELECT *  FROM `auction_bid` WHERE User_Id ='".$feitem['User_Id']."' AND Item_Id ='".$feitem['Item_Id']."' AND Winner ='1'");
                        $feauser=$auser->fetch();
                        
                        $User=$db->query("SELECT *  FROM `auction_user` WHERE User_Id ='".$feitem['User_Id']."'");
                        
                        if($feauser['User_Id']== $feitem['User_Id'] && $feauser['Item_Id']==$feitem['Item_Id'] && $feauser['Winner'] =='1'  ):
                            $feUser = $User->fetch();
                            $ph[$i]['Winner'] = $feUser ['User_Name'];
                                $ph[$i]['Winner_ProfilePic'] = $feUser['User_ProfilePic'] != '' ? $DefaultUrl . $feUser['User_ProfilePic'] : $feUser['User_ProfilePic'];
                                
                                $ph[$i]['Winning_Price'] = $feauser['Bid_Price'];
                        endif;

                    elseif ($tmpCurrent_date < $tmpStart_date):

                        $ph[$i]["Auction"] = "AUCTION IS UPCOMING";
                    else:

                        $ph[$i]["Auction"] = "AUCTION IS ENDED";

                    endif;
                    
                    $bid = $db->query("SELECT * FROM `auction_bid` where Item_Id='".$feitem['Item_Id']."' order by Bid_id DESC ");
                    
                    $b = 0;  $d = '';  $bi = array();
                    while ($febid = $bid->fetch()) {
                        $bi[$b]["Item_Id"] = $feitem['Item_Id'];
                        $bi[$b]["Bid_id"] = $febid['Bid_id'];
                        $bi[$b]["User_Id"] = $febid['User_Id'];
                        $user1 = $db->query("SELECT * FROM auction_user WHERE User_Id = '" . $febid['User_Id'] . "'");
                        $feuser1 = $user1->fetch();
                        $bi[$b]["User_Name"] = $feuser1['User_Name'];
                        $bi[$b]['User_ProfilePic'] = $feuser1['User_ProfilePic'] != '' ? $DefaultUrl . $feuser1['User_ProfilePic'] : $feuser1['User_ProfilePic'];
                        $bi[$b]["Bid_Price"] = $febid['Bid_Price'];
                        $bi[$b]["Active"] = ago($febid['created']);
                        $b++; 
                    }
                    $ph[$i]["BidList"] = $bi;
                }

                if ($Item_Type == '1' ) {
                    $ph[$i]["Item_NormalPrice"] = $feitem['Item_NormalPrice'];   
                }
                $trade = $db->query("SELECT * FROM trade WHERE User_Id = '$User_Id' AND Item_Id = '".$feitem['Item_Id']."'");
                $ph[$i]["is_trade"] = $trade->rowCount();
                $i++;
            }
            if (sizeof($ph) > 0) {

                $response['success'] = 1;

                $response['ItemList'] = $ph;
                
                $response['message'] = "Item List found";
            } 
            else 
            {
                $response['success'] = 0;
                $response['message'] = "No listings Available";
            }
        } 
        else 
        {
            $response['success'] = 0;
            $response['message'] = "No listings Available";
        }
    } 
    else 
    {
        $response["success"] = 0;
        $response["message"] = "Fields are missing";
    }
} 
else 
{
    $response["success"] = 0;
    $response["message"] = "Invalid Request Type(Use POST Method)";
}
        echo json_encode($response);
?>
