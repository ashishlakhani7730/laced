<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('m_login');
    }

    public function index() {
        $this->load->view('login_view');
    }

    public function forgot() {
        $this->load->view('forgotpwd_view');
    }

    public function checkdata() {
	
        $check_value = $this->m_login->validate($_POST['Admin_UserName'], $_POST['Admin_Password']);
		
        if (isset($check_value['Admin_Id'])) {
            $this->session->set_userdata('Admin_Id', $check_value['Admin_Id']);
            $this->session->set_userdata('Admin_Email', $check_value['Admin_Email']);
            $this->session->set_userdata('Admin_Name', $check_value['Admin_Name']);
            $this->session->set_userdata('Admin_Role', $check_value['Admin_Role']);
			$this->session->set_userdata('Admin_Type', $check_value['Admin_Type']);
            $this->session->set_userdata('Admin_ProfilePic', $check_value['Admin_ProfilePic']);
            $this->session->set_userdata('Admin_Password', $check_value['Admin_Password']);
            $this->session->set_flashdata('message', 'login successfully');
            redirect("home/index");
        } else {
            $this->session->set_flashdata('fail_message', 'Please Enter Valid Username and Password');
            redirect("login/index");
        }
    }

    public function forgotpass() {

     $Admin_Email = $this->input->post('Admin_Email');
        $check = $this->m_login->check_name($Admin_Email);
     
        if (!empty($check)) {

            $Admin_Password = rand();
            $Admin_Id = $check['Admin_Id'];
            $newPassword = @$this->encrypt->encode($Admin_Password);
            
            $updateData = @$this->m_login->change_data($Admin_Id, $newPassword);

            $subject = 'Laced App Password Recover';
            $emailMessage = '<html>
                    <body>
                        <div style="background:#f2f2f2;margin:0 auto;max-width:640px;padding:20px 20px">
                            <table align="center" border="0" cellpadding="0" cellspacing="0">
                                <tbody>
                                <tr>
                                    <td>.</td>
                                </tr>
                                <tr>
                                    <td>                                                
                                        <div style="text-align: center;background-color: #2196F3;color: #Fff;font-family:"Open Sans", sans-serif;font-size:13px; padding: 1px;margin-top: 10px;border-radius:10px 10px 0 0;">
                                            <h2>Laced Apps Password</h2>
                                        </div>
                                        <div style="background:#fff;color:#5b5b5b;font-family:"Open Sans", sans-serif;font-size:13px;padding:10px 20px;margin:20px auto;line-height:17px;   border:1px #ddd solid;border-top:0;clear:both;margin-top: 0;border-radius: 0 0 10px 10px;">
                                            
                                                                                              
                                            <p>Please use the Password To Laced Apps</p>
                                            <p>Email: <strong>' . $Admin_Email . '</strong></p> 
                                            <p>Password: <strong>' . $Admin_Password . '</strong></p>                                                      
                                        </div>
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tbody> 
                                            <tr>
                                                <td>
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tbody>
                                                        <tr>
                                                            <td style="font-family:"Open Sans",Arial,sans-serif;font-size:12px;padding-bottom: 10px;text-align: center;">  This Password is Secure so Please,change your password in application.</td>
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

            require("./PHPMailer/PHPMailerAutoload.php");
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jignesh.sensussoft@gmail.com';   //
            $mail->Password = 'mnuacctkyncaczdd'; 
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // $mail->From = $DefaultEmailID;
            // $mail->FromName = $DefaultEmailSenderName;
            $mail->addAddress($Admin_Email);

            $mail->isHTML(true);

            $mail->Subject = $subject;
            $mail->Body = $emailMessage;
            $mail->smtpConnect(
                    array(
                        "ssl" => array(
                            "verify_peer" => false,
                            "verify_peer_name" => false,
                            "allow_self_signed" => true
                        )
                    )
            );
            if ($mail->send()) {
                $this->session->set_flashdata('message', 'Password Sent successfully. Please check your mail.');
                redirect("login/index");
            } else {
                $this->session->set_flashdata('fail_message', 'Password not changed successfully,Please try again.');
                redirect("login/forgot");
            }
        } else {
            $this->session->set_flashdata('fail_message', 'Email Is Wrong Please Check The Email Address ');
            redirect("login/forgot");
        }
    } 

    public function logout() {
        $this->session->sess_destroy();
        redirect("login/index");
    }
}
