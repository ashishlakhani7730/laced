<?php

include "db.php";
include "function.php";
header('Content-Type: application/json');
if (isset($_REQUEST['User_Id']) && isset($_REQUEST['referalcode'])) {
    $response = array();
    $User_Id = $_REQUEST['User_Id'];
    $referalcode = $_REQUEST['referalcode'];

    $created = date("Y-m-d H:i:s");

    $select = $db->query("SELECT User_Email FROM auction_user WHERE User_Id = '$User_Id'");
    $feselect = $select->fetch();
    $User_Email = $feselect['User_Email'];


    $check = $db->query("SELECT Sender_User_Id,sender_email,Receiver_User_Id,receiver_email,R_Id FROM referrals WHERE receiver_email = '$User_Email' AND referalcode = '$referalcode' AND usedcode='0'");

    if ($check->rowCount() > 0) {
        $fecheck = $check->fetch();
        $db->query("UPDATE referrals SET usedcode ='1',usedcodedate = NOW() WHERE R_Id = '" . $fecheck['R_Id'] . "'");

        $wallet = $db->query("SELECT * FROM  wallet_ledger WHERE User_Id = '" . $fecheck['Sender_User_Id'] . "' OR User_Id='" . $fecheck['Receiver_User_Id'] . "' ORDER BY Wallet_Id DESC");
        $fewallet = $wallet->fetch();
        $message = 'Use ' . $User_Email . ' Referal Code';



        if ($wallet->rowCount() > 0) {
            $fewallet = $wallet->fetch();
            $prebalace = $fewallet['Wallet_Current_Balance'] + 30;

            $db->query("INSERT INTO wallet_ledger (User_Id, Wallet_Pre_Balance, Wallet_Post_Balance, Message, Wallet_Current_Balance) VALUES 
                    ('" . $fecheck['Sender_User_Id'] . "','" . $fewallet['Wallet_Current_Balance'] . "','$prebalace','$message','" . $fewallet['Wallet_Current_Balance'] . "') ");

            $db->query("INSERT INTO wallet_ledger (User_Id,Wallet_Pre_Balance,Wallet_Post_Balance,Message,Wallet_Current_Balance) VALUES 
                    ('" . $fecheck['Receiver_User_Id'] . "','" . $fewallet['Wallet_Current_Balance'] . "','$prebalace','$message','" . $fewallet['Wallet_Current_Balance'] . "') ");

            $db->query("UPDATE auction_user SET Wallet_Balance = '$prebalace' where User_Id = '" . $fecheck['Sender_User_Id'] . "' OR User_Id='" . $fecheck['Receiver_User_Id'] . "' ");
        
            
        } else {
            $db->query("INSERT INTO wallet_ledger (User_Id, Wallet_Pre_Balance, Wallet_Post_Balance, Message, Wallet_Current_Balance) VALUES ('" . $fecheck['Sender_User_Id'] . "','0','30','$message','30') ");

            $db->query("INSERT INTO wallet_ledger (User_Id, Wallet_Pre_Balance, Wallet_Post_Balance, Message, Wallet_Current_Balance) VALUES ('" . $fecheck['Receiver_User_Id'] . "','0','30','$message','30') ");
            $db->query("UPDATE auction_user SET Wallet_Balance = '30' where User_Id = '" . $fecheck['Sender_User_Id'] . "' OR User_Id='" . $fecheck['Receiver_User_Id'] . "' ");
        }

        $response['success'] = 1;
        $response['message'] = "$30 added in your Wallet.";
    } else {
        $response['success'] = 0;
        $response['message'] = "Please Enter valid Referal Coupan Code.";
    }
} else {
    $response["success"] = 0;
    $response["message"] = "Fields are missing";
}
echo json_encode($response);
?>