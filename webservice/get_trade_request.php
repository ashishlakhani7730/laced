<?php
include "db.php";
include "function.php";
header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST")
{
    if(isset($_REQUEST['User_Id']))
    {
        $response = array();
        $User_Id = $_REQUEST['User_Id'];
        $trade = $db->query("SELECT * FROM trade WHERE User_Id = '$User_Id' AND Trade_Status = 0");

        if($trade->RowCount() > 0)
        {
            $i = 0;
            $d = '';
            $ph = array();
        
            while ($fetrade = $trade->fetch()) {
				$ph[$i]["Trade_Id"] = $fetrade['Trade_Id'];
				$from_user = $db->query("SELECT * FROM auction_user WHERE User_Id = '".$fetrade['Receiver_Id']."'");
				$fe_from_user = $from_user->fetch();
				$ph[$i]["from_User_Id"] = $fe_from_user['User_Id'];
				$ph[$i]["from_User_Name"] = $fe_from_user['User_Name'];
				$ph[$i]["User_ProfilePic"] = $fe_from_user['User_ProfilePic'] != '' ? $DefaultUrl.$fe_from_user['User_ProfilePic'] : '';
				$ph[$i]["User_verified"] = $fe_from_user['User_verified'];
				$ph[$i]["date"] = $fe_from_user['created'];
				$ph[$i]["Item_Id"] = $fetrade['have_Item_Id'];
				
				$item = $db->query("SELECT * FROM auction_item WHERE Item_Id = '".$fetrade['have_Item_Id']."'");
				$feitem = $item->fetch();
				$brand = $db->query("SELECT * FROM auction_brand WHERE Brand_Id='".$feitem['Brand_Id']."'");
				$febrand = $brand->fetch();

				$ph[$i]["haveitem"] = array(
					'haveitemid' => $feitem['Item_Id'],
					'haveitemname' => $feitem['Item_Name'],
					'haveitemfrontpicture' => $DefaultUrl.$feitem['Item_FrontPicture'],
					'haveitemnormalprice' => $feitem['Item_MarketPrice'],
					'haveitemtype' => $feitem['Item_Type'],
					'haveitembrand' => $febrand['Brand_Name']
					);

				$itemids = explode(",",$fetrade['Item_Id']);
				foreach($itemids as $key => $item)
				{
					$get_item = $db->query("SELECT * FROM auction_item WHERE Item_id = '$item'");
					$dataitem = $get_item->fetch();
					$getbrandname = $db->query("SELECT * FROM auction_brand WHERE Brand_Id = '".$dataitem['Brand_Id']."'");
					$brandname = $getbrandname->fetch();

					$ph[$i]["itemdetail"][$key]['Item_Id'] = $dataitem['Item_Id'];
					$ph[$i]["itemdetail"][$key]['Item_Name'] = $dataitem['Item_Name'];
					$ph[$i]["itemdetail"][$key]['Item_FrontPicture'] = $DefaultUrl.$dataitem['Item_FrontPicture'];
					$ph[$i]["itemdetail"][$key]['Item_NormalPrice'] = $dataitem['Item_NormalPrice'];
					$ph[$i]["itemdetail"][$key]['Item_Type'] = $dataitem['Item_Type'];
					$ph[$i]["itemdetail"][$key]['brandname'] = $brandname['Brand_Name'];
				}
				$i++;
            }
        }
        else
        {
            $response['success'] = 0;
            $response['message'] = "No Trade Request found";
        }
        if (isset($ph) && sizeof($ph) > 0) 
        { 
            $response['success'] = 1;
            $response['message'] = "request List found";
            $response['traderequestlist'] = $ph;
        } 
        else 
        {
            $response['success'] = 0;
            $response['message'] = "No Trade Request found";
        }
    }  else {
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