<?php

include "db.php";
include "function.php";
header('Content-Type: application/json');
if (isset($_REQUEST['User_Id'])&& isset($_REQUEST['receiver_email']) ) {
    $response = array();
    $User_Id = $_REQUEST['User_Id'];
    $receiver_email= $_REQUEST['receiver_email'];
    $referalcode = substr(md5(rand()), 0, 6);
    $created = date("Y-m-d H:i:s");

    $getreciveremail = $db->query("SELECT receiver_email FROM referrals WHERE Sender_User_Id = '$User_Id' AND receiver_email='$receiver_email'");
    $emails = $getreciveremail->fetch();

    if ($emails['receiver_email'] == '') {
        $select = $db->query("SELECT User_Email FROM auction_user WHERE User_Id = '$User_Id'");

        if ($select->RowCount() > 0) {
            $feselect = $select->fetch();
            $User_Email = $feselect['User_Email'];

            $select1 = $db->query("SELECT User_Id FROM auction_user WHERE User_Email = '$receiver_email'");
            $feselect1 = $select1->fetch();
            $Receiver_Id = $feselect1['User_Id'];
          
           $insert = $db->query("INSERT INTO `referrals` (Sender_User_Id,Receiver_User_Id, sender_email, receiver_email, referalcode, created) VALUES ('$User_Id','$Receiver_Id','$User_Email', '$receiver_email', '$referalcode', '$created')");


            $messagebody = '<html>
								<body>
									<div style="background:#f2f2f2;margin:0 auto;max-width:640px;padding:20px 20px">
										<table align="center" border="0" cellpadding="0" cellspacing="0">
											<tbody>
											<tr>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td>                                                
													<div style="text-align: center;background-color: #2196F3;color: #Fff;font-family:"Open Sans", sans-serif;font-size:13px; padding: 1px;margin-top: 10px;border-radius:10px 10px 0 0;">
														<h2>Referal Code</h2>
													</div>
													<div style="background:#fff;color:#5b5b5b;font-family:"Open Sans", sans-serif;font-size:13px;padding:10px 20px;margin:20px auto;line-height:17px;   border:1px #ddd solid;border-top:0;clear:both;margin-top: 0;border-radius: 0 0 10px 10px;">
														
														<p>Dear User,</p>                                                    
														<p>Please use the following Unique Referral Code for the Laced Apps account</p>
														<p>Your Referalcode: <strong>' . $referalcode . '</strong></p>                                                   
													</div>
													<table border="0" cellpadding="0" cellspacing="0" width="100%">
														<tbody> 
														<tr>
															<td>
																<table border="0" cellpadding="0" cellspacing="0" width="100%">
																	<tbody>
																	<tr>
																		<td style="font-family:"Open Sans",Arial,sans-serif;font-size:12px;padding-bottom: 10px;text-align: center;"> If you have any issue, feel free to contact us at <a href="mailto:' . $DefaultEmailID . '" style="color:#000;font-weight:bold;text-decoration:none" target="_blank"> ' . $DefaultEmailID . ' </a> .
																		</td>
																	</tr>
																	</tbody>
																</table>
															</td>
														</tr>
														</tbody>
													</table>
												</td>
											</tr>
											</tbody>
										</table>
									</div>
								</body>
							</html>';

            require("../../GoGosafely/PHPMailer/PHPMailerAutoload.php");
        $mail = new PHPMailer;

        $mail->isSMTP();                  
        $mail->SMTPAuth = true;

        $mail->From = $DefaultEmailID;
        $mail->FromName = $DefaultEmailSenderName;
            $mail->addAddress($receiver_email);

            $mail->isHTML(true);
	
            $mail->Subject = 'Laced App Referral code ';
            $mail->Body = $messagebody;
            $mail->smtpConnect(
                    array(
                        "ssl" => array(
                            "verify_peer" => false,
                            "verify_peer_name" => false,
                            "allow_self_signed" => true
                        )
                    )
            );
            // echo "Mailer Error: " . $mail->ErrorInfo;
            if ($mail->send()) {
           
                $response['success'] = 1;
                $response['message'] = "Get $30, please check your Email for referral code";
            } else {
                $response['success'] = 0;
                $response['message'] = "referalcode not send ,Please try again";
            }
        }
    } else {
        $response['success'] = 0;
        $response['message'] = "You Have Alredy Invited To This Email Please Try Somthing New!";
    }
} else {
    $response["success"] = 0;
    $response["message"] = "Fields are missing";
}
echo json_encode($response);
?>