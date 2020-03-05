<?php

header('Content-Type: application/json');
$checkFields = "";
$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST")
{
    if( isset($_REQUEST['User_Id']) && isset($_REQUEST['User_FullName']) && isset($_REQUEST['User_Name']) && isset($_REQUEST['User_Email']) && isset($_REQUEST['User_Address']) && isset($_REQUEST['User_Phone']) && isset($_REQUEST['User_UnitNo'])  && isset($_REQUEST['User_City']) && isset($_REQUEST['User_State'])  )
    {
        $response = array();
        include "db.php";
      

        $User_Id = $_REQUEST['User_Id'];
        $User_FullName= $_REQUEST['User_FullName'];
		$User_Name = $_REQUEST['User_Name'];
        $User_Email = $_REQUEST['User_Email'];
        $User_Address = $_REQUEST['User_Address'];
        $User_UnitNo= $_REQUEST['User_UnitNo'];
        $User_City= $_REQUEST['User_City'];
        $User_State= $_REQUEST['User_State'];
        $User_Phone= $_REQUEST['User_Phone'];

            $seluser = $db->query("SELECT * from auction_user WHERE User_Id = '$User_Id'");
            $feuser = $seluser->fetch();

            
            if(isset($_FILES['User_ProfilePic']['name']))
            {
                if(!empty($_FILES['User_ProfilePic']['name']))
                {
                    if($feuser['User_ProfilePic'] != 'default_image.png')
                    {
                         unlink("../Items/" . $feuser['User_ProfilePic']);
                    }
                    
                    ("../Items/" . $feuser['User_ProfilePic']);
                    $User_ProfilePic=$_FILES["User_ProfilePic"]["name"];
                    $file_tmp=$_FILES["User_ProfilePic"]["tmp_name"];
                    $ext=strtolower(pathinfo($User_ProfilePic,PATHINFO_EXTENSION));
                    $extension =  array('gif','png' ,'jpg','jpeg');
                    if(in_array($ext,$extension))
                    {
                        if(!file_exists("../Items/".$User_ProfilePic))
                        {
                            move_uploaded_file($file_tmp=$_FILES["User_ProfilePic"]["tmp_name"],"../Items/".$User_ProfilePic);
                        }
                        else
                        {
                            $User_ProfilePic=basename($User_ProfilePic,$ext);
                            $User_ProfilePic=$User_ProfilePic.rand().".".$ext;
                            move_uploaded_file($file_tmp=$_FILES["User_ProfilePic"]["tmp_name"],"../Items/".$User_ProfilePic);
                        }
                    } 
                }else
                {
                     $User_ProfilePic= $feuser['User_ProfilePic'];
                }      

            $update = $db->query("UPDATE auction_user SET User_FullName= '$User_FullName', User_Name = '$User_Name', User_Email = '$User_Email', User_Address = '$User_Address',User_UnitNo= '$User_UnitNo',User_City= '$User_City',User_State= '$User_State',User_Phone = '$User_Phone',  User_ProfilePic = '$User_ProfilePic' WHERE User_Id = '$User_Id'");
            if($update)
            {
                $response["success"] = 1;
                $response["User_Id"] = $User_Id;
                $response["User_FullName"] = $User_FullName;
				$response["User_Name"] = $User_Name;
                $response["User_Email"] = $User_Email;
                $response["User_Address"] = $User_Address;
                
                $response["User_UnitNo"] = $User_UnitNo;
                $response["User_City"] = $User_City;
                $response["User_State"] = $User_State;
                $response["User_Phone"] = $User_Phone;
                $response["User_ProfilePic"] = $feuser['User_ProfilePic'] != '' ? $DefaultUrl . $User_ProfilePic : $User_ProfilePic;
                $response["message"] = "Profile details updated successfully";
            }
            else
            {
                $response["success"] = 0;
                $response["message"] = "Profile details not updated,Please try again.";
            }
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
