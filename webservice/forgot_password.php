<?php
include "db.php";  
header('Content-Type: application/json');
if(isset($_REQUEST['User_Email']))
{
    $response = array();  
    $User_Email = $_REQUEST['User_Email'];    

    $query = $db->query("SELECT * from `auction_user` where User_Email = '$User_Email'");
    if($query->RowCount() > 0)
    {
        $fequery = $query->fetch();
        $Password = $fequery['User_Password'];

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
                                                    <h2>Password Recovery</h2>
                                                </div>
                                                <div style="background:#fff;color:#5b5b5b;font-family:"Open Sans", sans-serif;font-size:13px;padding:10px 20px;margin:20px auto;line-height:17px;   border:1px #ddd solid;border-top:0;clear:both;margin-top: 0;border-radius: 0 0 10px 10px;">
                                                    
                                                    <p>Dear User,</p>                                                    
                                                    <p>Please use the following security password for the Laced apps account</p>
                                                    <p>Your Password: <strong>'.$Password.'</strong></p>                                                   
                                                </div>
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                    <tbody> 
                                                    <tr>
                                                        <td>
                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                <tbody>
                                                                <tr>
                                                                    <td style="font-family:"Open Sans",Arial,sans-serif;font-size:12px;padding-bottom: 10px;text-align: center;"> If you have any issue, feel free to contact us at <a href="mailto:'.$DefaultEmailID.'" style="color:#000;font-weight:bold;text-decoration:none" target="_blank"> '.$DefaultEmailID.' </a> .
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

        require("../PHPMailer/PHPMailerAutoload.php");
        $mail = new PHPMailer;

        $mail->isSMTP();                                      
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'jignesh.sensussoft@gmail.com';   //
        $mail->Password = 'mnuacctkyncaczdd'; 
        $mail->SMTPSecure = 'tls'; 
        $mail->Port = 587;

        $mail->From = $DefaultEmailID;
        $mail->FromName = $DefaultEmailSenderName;
        $mail->addAddress($User_Email);              

        $mail->isHTML(true);                                  

        $mail->Subject = 'Laced app Password Recovery';
        $mail->Body    = $messagebody;
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
        if($mail->send())
        {
            $response['success'] = 1;
            $response['message'] = "Your password changed successfully, please check our mail";
        }
        else
        {
            $response['success'] = 0;
            $response['message'] = "Password not changed successfully,Please try again";
        }
    }
    else
    {
        $response["success"] = 0;
        $response["message"] = "Email Is Wrong Please Check The Email Address !!"; 
    }
} 
else
{
    $response["success"] = 0;
    $response["message"] = "Fields are missing";          
}
echo json_encode($response);
?>