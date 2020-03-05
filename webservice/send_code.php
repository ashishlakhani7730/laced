<?php
error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json');
include "db.php";

$REQUEST = $_SERVER['REQUEST_METHOD'];
if ($REQUEST == "POST")
{

    if (isset($_REQUEST['ContactNo']) && isset($_REQUEST['Email'])) 
    {
        $code =  mt_rand(100000,999999);
        $message = 'Laced app to payment method set verification OTP:'.$code;
        if(!empty($_REQUEST['ContactNo'])):
            $mobile=$_REQUEST['ContactNo'];
            $json = json_decode(file_get_contents("https://smsapi.engineeringtgr.com/send/?Mobile=8758576380&Password=2561203123s&Message=".urlencode($message)."&To=".urlencode($mobile)."&Key=jigneV38rTEA9ZaWGpfLy5c1SuQ") ,true);
        endif;
    
        if(!empty($_REQUEST['Email'])):
            $Email = $_REQUEST['Email'];
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
                                                        <h2>Pyment Details Update Code</h2>
                                                    </div>
                                                    <div style="background:#fff;color:#5b5b5b;font-family:"Open Sans", sans-serif;font-size:13px;padding:10px 20px;margin:20px auto;line-height:17px;   border:1px #ddd solid;border-top:0;clear:both;margin-top: 0;border-radius: 0 0 10px 10px;">
                                                        
                                                        <p>Dear User,</p>                                                    
                                                        <p>Please use the following Code to set payment method in Laced app</p>
                                                        <p>Code: <strong>'.$code.'</strong></p>                                                   
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
            $mail->Username = 'jignesh.sensussoft@gmail.com';   
            $mail->Password = 'xmdteqlkkhpgfkni'; 
            $mail->SMTPSecure = 'tls'; 
            $mail->Port = 587;

            $mail->From = 'payment@golaced.com';
            $mail->FromName = 'Laced Apps';
            $mail->addAddress($Email);              

            $mail->isHTML(true);                                  

            $mail->Subject = 'Laced Set up Payment Verification';
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
            $mail->send();
        endif;
        $response['success'] = 1;    
        $response['OTP'] = $code;            
        $response['message'] = "Otp Code Successfully Sent";

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
