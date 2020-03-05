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

        $current_date = (date("Y-m-d H:i:s"));

        $item = $db->query("SELECT * FROM `auction_item` ");

        if ($item->Rowcount() > 0) {
            $i = 0;
            $d = '';
            $ph = array();

            while ($feitem = $item->fetch()) {
                $ph[$i]["Item_Id"] = $feitem['Item_Id'];
                $ph[$i]["Item_Name"] = $feitem['Item_Name'];
                $brand = $db->query("select * from auction_brand where Brand_Id='" . $feitem['Brand_Id'] . "'");
                $febrand = $brand->fetch();
                
                $trade = $db->query("SELECT * FROM `trade` where  FIND_IN_SET( '" . $feitem['Item_Id'] . "', Item_Id ) AND User_Id='" . $feitem['User_Id'] . "' ORDER BY Trade_Id DESC");
                $tr = array();
                $t = 0;

                while ($fetrade = $trade->fetch()) {
                    $tr[$t]["Trade_Id"] = $fetrade ['Trade_Id'];
                    $tr[$t]["Item_Id"] = $feitem['Item_Id'];
                    $tr[$t]["Item_Name"] = $feitem['Item_Name'];
                    $tr[$t]["Brand_Name"] = ($febrand['Brand_Name']) ? $feBrand ['Brand_Name'] : '';
                    $tr[$t]["Item_FrontPicture"] = $feitem['Item_FrontPicture'] != '' ? $DefaultUrl . $feitem['Item_FrontPicture'] : $feitem['Item_FrontPicture'];
                    $tr[$t]["created"] = $feitem['created'];
		    
		    $order = $db->query("SELECT * FROM auction_user_order WHERE Item_Id ='".$feitem['Item_Id']."'  OR User_Id = '" . $fetrade ['User_Id'] . "'");
                    $feorder = $order->fetch();
                    
                    
                    $us = $db->query("select User_Name from auction_user where User_Id='" . $fetrade['User_Id'] . "'");
                    $feus = $us->fetch();
                    $User_Name = $feus['User_Name'];
                    $tr[$t]["Seller_Name"] = $User_Name;

                    $tr[$t]["Tracking_No"] = $feorder['Tracking_No3'];
                    $tr[$t]["Order_Id"] = $feorder['Order_Id'];
                    $tr[$t]["Trade_Accepted_On"] = $fetrade['created'];
                    $inside = array();

                    $item_id = explode(",", $feitem['Item_Id']);

                    for ($in = 0; $in < count($item_id); $in++) {
                        $initem = $db->query("SELECT * FROM auction_item WHERE Item_Id = '" . $item_id[$in] . "'");
                        $initems = $initem->fetch();

                        $inside[$in]["Item_Name"] = $initems['Item_Name'];
                        $inside[$in]["Item_FrontPicture"] = $initems['Item_FrontPicture'] != '' ? $DefaultUrl . $initems['Item_FrontPicture'] : $initems['Item_FrontPicture'];
                        $inside[$in]["Item_NormalPrice"] = $initems['Item_NormalPrice'];
                        $inside[$in]["Item_Condition"] = $initems['Item_Condition'];
                        $inside[$in]["Item_Size"] = $initems['Item_Size'];
                        $inside[$in]["Item_Box"] = $initems['Item_Box'] != '' ? $initems['Item_Box'] : '';

                        $in++;
                    }

                    $tr[$t]["insideitem"] = $inside;


                    $product = $db->query("SELECT Item_Id  FROM `trade`  where User_Id='" . $feitem['User_Id'] . "' ");
                    $feproducts = $product->fetchAll(PDO::FETCH_ASSOC);
			
                    $activeUsers = [];
                    foreach ($feproducts as $feproduct):
                        $activeUsers[] = $feproduct['Item_Id'];
                    endforeach;

                    $itemId = implode(',', $activeUsers);

                    $o = 0;
                    $or = array();
                    
                    
                    $order = $db->query("SELECT * FROM `auction_item` where Item_Id IN ($itemId ) ");
                    $feorder = $order->fetch();
                    
                    while($feorder = $order->fetch()){
                    $us = $db->query("select User_Name from auction_user where User_Id='" . $fetrade['User_Id'] . "'");
                    $feus = $us->fetch();
                    $User_Name = $feus['User_Name'];
                    

                    $or[$o]["Item_Id"] = $feorder['Item_Id'];
                    
                    $or[$o]["Item_Name"] = $feitem['Item_Name'];
                    $Brand = $db->query("select * from auction_brand where Brand_Id='" . $feorder['Brand_Id'] . "'");
                    $feBrand = $Brand->fetch();
                    
                    $or[$o]["Brand_Name"] = ($feBrand ['Brand_Name']) ? $feBrand ['Brand_Name'] : '';
                    $or[$o]["Item_FrontPicture"] = $feitem['Item_FrontPicture'] != '' ? $DefaultUrl . $feitem['Item_FrontPicture'] : $feitem['Item_FrontPicture'];
                    $or[$o]["Item_NormalPrice"] = $feitem['Item_NormalPrice'];
		    $or[$o]["Item_Condition"] = $feitem['Item_Condition'];
		    $or[$o]["Item_Size"] = $feitem['Item_Size'];
		    $or[$o]["Item_Box"] = $feitem['Item_Box']!= '' ? $initems['Item_Box'] : '';
                    $o++;
                    }

                    $tr[$t]["ItemList"] = $or;
                    if ($current_date > $fetrade['created']) {
                        $Trade[] = $tr[$t];
                    }
                     
                    $t++;
                   
                }


                $purchase = $db->query("select * from user_purchase_item where  Item_Id ='" . $feitem['Item_Id'] . "' AND Seller_Id='" . $feitem['User_Id'] . "' ");
                $pu = array();
                $p = 0;
                while ($fepurchase = $purchase->fetch()) {

                    $pu[$p]["Item_Id"] = $feitem['Item_Id'];
                    $pu[$p]["Item_Name"] = $feitem['Item_Name'];
                    $pu[$p]["Brand_Name"] = ($febrand['Brand_Name']) ? $feBrand ['Brand_Name'] : '';
                    $pu[$p]["Item_FrontPicture"] = $feitem['Item_FrontPicture'] != '' ? $DefaultUrl . $feitem['Item_FrontPicture'] : $feitem['Item_FrontPicture'];
                    $pu[$p]["created"] = $feitem['created'];
                    $a = 0;
                    $pa = array();
                    $pa[$a]["Item_NormalPrice"] = $feitem['Item_NormalPrice'];
                    $pa[$a]["Item_Condition"] = $feitem['Item_Condition'];
                    $pa[$a]["Item_Size"] = $feitem['Item_Size'];
                    $pa[$a]["Item_Box"] = $feitem['Item_Box'] != '' ? $feitem['Item_Box'] : '';

                    $Order = $db->query("SELECT * FROM auction_user_order WHERE Item_Id= '" . $feitem['Item_Id'] . "' AND User_Id = '" . $fepurchase['User_Id'] . "'");
                    $feOrder = $Order->fetch();

                    if ($feOrder['Order_Complete'] == '0') {
                        $pa[$a]["Is_Order_Complete"] = "0";
                    } elseif ($feOrder['Order_Complete'] == '1') {
                        $pa[$a]["Is_Order_Complete"] = "1";
                    }

                    $pa[$a]["Order_Id"] = $feOrder['Order_Id'];

                    $pa[$a]["Tracking_No"] = $feOrder['Tracking_No'];
                    $pa[$a]["Order_On"] = $feOrder['created'];
                    $a++;
                    $pu[$p]["Order"] = $pa;

                    if ($current_date > $fepurchase['created']) {
                        $Purchase[] = $pu[$p];
                    }
                    $p++;
                }

                $sold = $db->query("SELECT * FROM user_purchase_item WHERE Item_Id ='" . $feitem['Item_Id'] . "' AND Seller_Id= '" . $feitem['User_Id'] . "' ");
                $so = array();
                $s = 0;
                while ($fesold = $sold->fetch()) {

                    $so[$s]["Item_Id"] = $fesold['Item_Id'];
                    $so[$s]["Item_Name"] = $feitem['Item_Name'];
                    $so[$s]["Brand_Name"] = ($febrand['Brand_Name']) ? $feBrand ['Brand_Name'] : '';
                    $so[$s]["Item_FrontPicture"] = $feitem['Item_FrontPicture'] != '' ? $DefaultUrl . $feitem['Item_FrontPicture'] : $feitem['Item_FrontPicture'];
                    $so[$s]["created"] = $feitem['created'];
                    $r = 0;
                    $ra = array();
                    $ra[$r]["Item_NormalPrice"] = $feitem['Item_NormalPrice'];
                    $ra[$r]["Item_Condition"] = $feitem['Item_Condition'];
                    $ra[$r]["Item_Size"] = $feitem['Item_Size'];

                    $ra[$r]["Item_Box"] = $feitem['Item_Box'] != '' ? $feitem['Item_Box'] : '';
                    $user = $db->query("SELECT * FROM auction_user WHERE User_Id = '" . $fesold['User_Id'] . "' ");
                    $feuser = $user->fetch();
                    $ra[$r]["User_Id"] = $fesold['User_Id'];



                    if ($fesold['Purchase'] == '0') {
                        $ra[$r]["Is_ConfirmSale"] = "0";
                        $ra[$r]["Mark_As_Shipped"] = "0";
                    } elseif ($fesold['Purchase'] == '1') {
                        $ra[$r]["Is_ConfirmSale"] = "1";
                        $ra[$r]["Mark_As_Shipped"] = "0";
                    } elseif ($fesold['Purchase'] == '2') {
                        $ra[$r]["Is_ConfirmSale"] = "1";
                        $ra[$r]["Mark_As_Shipped"] = "1";
                    }


                    $Order1 = $db->query("SELECT Order_Id FROM auction_user_order WHERE Item_Id ='" . $fesold['Item_Id'] . "' AND Seller_Id= '" . $fesold['Seller_Id'] . "' AND User_Id='" . $fesold['User_Id'] . "'");
                    $feOrder1 = $Order1->fetch();
                    $Order_Id = $feOrder1['Order_Id'];
                    $ra[$r]["Order_Id"] = $Order_Id;


                    $payment = $db->query("SELECT * FROM auction_item where User_Id ='$User_Id' ");

                    $TotalEarned = 0;

                    while ($fepayment = $payment->fetch()) {
                        $TotalEarned = $TotalEarned + $fepayment['Item_NormalPrice'];
                    }
                    $ra[$r]["Total_Earned"] = $TotalEarned;



                    $r++;
                    $so[$s]["Order"] = $ra;

                    if ($current_date > $fesold['created']) {
                        $Sold[] = $so[$s];
                    }
                    $s++;
                }


                $i++;
            }
            if (sizeof($ph) > 0) {
                $response['success'] = 1;
                $response['Traded'] = $Trade;
                $response['Purchased'] = $Purchase;
                $response['Sold'] = $Sold;
                $response['message'] = "Past Transaction found";
            } else {
                $response['success'] = 0;
                $response['message'] = "No Transaction found";
            }
        } else {
            $response['success'] = 0;
            $response['message'] = "No Transaction found";
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
