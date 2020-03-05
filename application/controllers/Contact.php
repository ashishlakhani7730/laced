<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('m_contact');
    }

    public function index() {
        if ($this->session->userdata('Admin_Id')) {
            $data['contact_list'] = $this->m_contact->get_contact();
            $this->load->view('show_contact', $data);
        } else {
            redirect('login');
        }
    }

    public function solved_query() {
        if ($this->session->userdata('Admin_Id')) {
            $data['contact_list'] = $this->m_contact->solved_query();
            $this->load->view('solved_query', $data);
        } else {
            redirect('login');
        }
    }

    public function addreply() {
        $response = array();
        $Email = $this->input->post('Email');
        $Subject = $this->input->post('Subject');
        $Message = $this->input->post('Message');
        $check = $this->m_contact->check_name($Email);

        if (!empty($check)) {
            $Contact_Id = $check['Contact_Id'];
            $Contact_Status = $this->input->post('Contact_Status');
            
            $subject = 'Laced App Query Message';
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
                                            <h2>Laced Apps Query</h2>
                                        </div>
                                        <div style="background:#fff;color:#5b5b5b;font-family:"Open Sans", sans-serif;font-size:13px;padding:10px 20px;margin:20px auto;line-height:17px;   border:1px #ddd solid;border-top:0;clear:both;margin-top: 0;border-radius: 0 0 10px 10px;">
                                            
                                                                                              
                                            <p>Query Solution To Laced Apps</p>
                                            <p>Email: <strong>' . $Email . '</strong></p> 
                                            <p>Subject: <strong>' . $Subject . '</strong></p>   
                                            <p>Message: <strong>' . $Message . '</strong></p> 
                                        </div>
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tbody> 
                                            <tr>
                                                <td>
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tbody>
                                                        <tr>
                                                            <td style="font-family:"Open Sans",Arial,sans-serif;font-size:12px;padding-bottom: 10px;text-align: center;">  </td>
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

            //  $mail->From = $DefaultEmailID;
            //  $mail->FromName = $DefaultEmailSenderName;
            $mail->addAddress($Email);

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
                $updateData = $this->m_contact->solve_query($Contact_Id, $Contact_Status);
                $response['code'] = 1;
                $response['message'] = 'Message sent successfully.';
                
            } else {
                $response['code'] = 0;
                $response['message'] = 'Oops! message failed.';
                
            }
        } else {
            $response['code'] = 0;
            $response['message'] = 'Email Is Wrong Please Check The Email Address ';
            
        }
        echo json_encode($response);
        
    }
    public function delete_data() {

        $contact = $this->m_contact->delete_query($this->uri->segment(3));
        $this->session->set_flashdata('message', 'Query delete successfully...');
        redirect("Contact/solved_query");
    }

}
